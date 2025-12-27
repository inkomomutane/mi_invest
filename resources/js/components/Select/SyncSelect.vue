<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Command, CommandEmpty, CommandGroup, CommandInput, CommandItem, CommandList } from '@/components/ui/command';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { cn,t } from '@/lib/utils';
import {  ChevronUp,ChevronDown } from 'lucide-vue-next';
import {computed, PropType, ref, watch} from 'vue';

type AlignmentData = 'end'|'start';

const props = defineProps({
  options: {
    type: Array,
    default: () => [],
  },
    alignment: {
       type:  Object as PropType<AlignmentData>,
        default: 'start'
    },
  reduce: {
    type: Function,
    default: (option: any) => option,
  },
  getLabel: {
    type: Function,
    default: (option: any) => option,
  },
  getAvatar: {
    type: Function,
    required: false,
  },
  class: {
    default: '',
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  placeholder: {
    type: String,
    default: '',
  },
  async: {
    type: Boolean,
    default: false,
  },
});
const emit = defineEmits(['value:selected', 'value:deselected']);

const model = defineModel();

const selectedValue = computed(() => {
  return props.options.find((option) => props.reduce(option) === model.value) ?? null;
});

watch(
  selectedValue,
  (e) => {
    if (e) {
      emit('value:selected', e);
    }
  },
  {
    deep: true,
    immediate: true,
  },
);

const change = (option: any) => {

    if(model.value === props.reduce(option)) {
        model.value = null;
        emit('value:deselected', option);
        return;
    }

  model.value = props.reduce(option);
};

const open = ref(false);
</script>

<template>
  <Popover v-model:open="open">
    <PopoverTrigger as-child>
         <slot name="trigger">
             <Button
                 id="select-44"
                 variant="outline"
                 :disabled="disabled"
                 role="combobox"
                 :aria-expanded="open"
                 :class="cn('w-full min-w-32 justify-between bg-background px-3 font-normal hover:bg-background',props.class)"
             >
                 <template v-if="selectedValue">
          <span class="flex min-w-0 items-center gap-2 text-black">
            <span class="truncate">{{ getLabel(selectedValue) }}</span>
          </span>
                 </template>
                 <template v-else>
                     <span class="text-muted-foreground">{{ placeholder }}</span>
                 </template>
                 <ChevronUp v-if="open" :size="16" :stroke-width="2" class="shrink-0 text-muted-foreground/80" aria-hidden="true" />
                 <ChevronDown v-else :size="16" :stroke-width="2" class="shrink-0 text-muted-foreground/80" aria-hidden="true"/>
             </Button>
         </slot>
    </PopoverTrigger>
    <PopoverContent
      class="w-full min-w-[var(--reka-popper-anchor-width)] rounded-md border bg-popover p-0 text-xs text-popover-foreground shadow-lg"
      :align="props.alignment"
    >
      <Command>
        <CommandInput class="ring-none outline-hidden" :placeholder="placeholder" />
        <CommandList>
          <CommandEmpty>
            {{ t('No items found.') }}
          </CommandEmpty>
          <CommandGroup class="p-0">
            <CommandItem
              v-for="option in options"
              :key="reduce(option)"
              :data-value="option"
              @select="change(option)"
              :value="reduce(option)"
              class="p-0"
            >
              <div
                :class="
                  cn(
                    'flex w-full cursor-pointer flex-row items-center justify-between border-l-4 p-2 py-3 text-sm font-medium transition-colors duration-200 border-transparent',
                    {
                      'border-zinc-600 bg-zinc-100 dark:border-white dark:bg-zinc-900': selectedValue === option,
                      'border-white dark:border-950': !selectedValue === option,
                    },
                    [
                      'hover:bg-zinc-100 dark:hover:bg-zinc-900',
                      'focus:bg-zinc-100 dark:focus:bg-zinc-900',
                      '!min-w-72',
                      'outline-[0.5px] outline-gray-200/80 dark:outline-zinc-900/90 first-letter:uppercase',
                    ],
                  )
                "
              >
                <slot name="option" :props="option">
                  {{ getLabel(option) }}
                </slot>
              </div>
            </CommandItem>
          </CommandGroup>
        </CommandList>
      </Command>
      <Command>
        <slot name="newItem" />
      </Command>
    </PopoverContent>
  </Popover>
</template>
