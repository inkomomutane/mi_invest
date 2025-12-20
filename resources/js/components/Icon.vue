<script setup lang="ts">
import { cn } from '@/lib/utils';
import * as icons from 'lucide-vue-next';
import * as labIcons from '@lucide/lab';
import { Icon } from 'lucide-vue-next';
import { computed } from 'vue';

interface Props {
  name: string;
  class?: string;
  size?: number | string;
  color?: string;
  strokeWidth?: number | string;
  lab?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
  class: '',
  size: 16,
  strokeWidth: 2,
  lab: false,
});

const className = computed(() => cn('h-4 w-4', props.class));

type ResolvedIcon = {
  kind: 'component' | 'iconNode' | 'unknown';
  value: any | null;
};

const resolveExport = (exp: any): ResolvedIcon => {
  if (!exp) return { kind: 'unknown', value: null };
  // unwrap default interop
  if (exp.default) exp = exp.default;

  // some exports have an `icon` property with raw node data
  if (exp.icon) {
    const node = exp.icon;
    if (Array.isArray(node) || typeof node === 'object') return { kind: 'iconNode', value: node };
  }

  // Vue component detection (functional or object with render/setup/props)
  if (
    typeof exp === 'function' ||
    (typeof exp === 'object' &&
      (exp.render || exp.setup || exp.props || exp.__file || exp.name))
  ) {
    return { kind: 'component', value: exp };
  }

  // icon node detection (array or plain object describing SVG)
  if (Array.isArray(exp) || (typeof exp === 'object' && (exp.tag || exp.attrs || exp.children))) {
    return { kind: 'iconNode', value: exp };
  }

  return { kind: 'unknown', value: null };
};

const tryNameTransforms = [
  (n: string) => fromStringToIconName(n),
  (n: string) => fromStringToIconName2(n),
  (n: string) => fromStringToIconName3(n),
];

const iconResolved = computed<ResolvedIcon>(() => {
  const name = props.name || '';
  // Try lucide-vue-next then labIcons
  for (const transform of tryNameTransforms) {
    const key = transform(name);
    let exp = (icons as Record<string, any>)[key];
    if (exp) return resolveExport(exp);
  }

  for (const transform of tryNameTransforms) {
    const key = transform(name);
    let exp = (labIcons as Record<string, any>)[key];
    if (exp) return resolveExport(exp);
  }

  console.warn(`Icon "${props.name}" not found in lucide or lab exports.`);
  return { kind: 'unknown', value: null };
});

const isComponent = computed(() => iconResolved.value.kind === 'component');
const isIconNode = computed(() => iconResolved.value.kind === 'iconNode');
const iconValue = computed(() => iconResolved.value.value);

// basket-ball-fill => BasketBallFill
const fromStringToIconName = (name: string) => {
  return name
    .split(/[-_]/)
    .map((part) => part.charAt(0).toUpperCase() + part.slice(1))
    .join('');
};

// basket-ball-fill => basketBallFill
const fromStringToIconName2 = (name: string) => {
  const parts = name.split(/[-_]/);
  return parts
    .map((part, index) => {
      if (index === 0) {
        return part.toLowerCase();
      }
      return part.charAt(0).toUpperCase() + part.slice(1);
    })
    .join('');
};

// basket-ball-fill => basketballfill
const fromStringToIconName3 = (name: string) => {
  return name.replace(/[-_]/g, '').toLowerCase();
};
</script>

<template>
  <component
    v-if="isComponent && iconValue"
    :is="iconValue"
    :class="className"
    :size="size"
    :stroke-width="strokeWidth"
    :color="color"
  />
  <Icon
    v-else-if="isIconNode && iconValue"
    :iconNode="iconValue"
    :class="className"
    :size="size"
    :stroke-width="strokeWidth"
    :color="color"
  />
</template>
