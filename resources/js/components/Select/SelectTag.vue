<script setup lang="ts">
import { Combobox, ComboboxAnchor, ComboboxEmpty, ComboboxGroup, ComboboxInput, ComboboxItem, ComboboxList } from '@/common/components/ui/combobox';
import { TagsInput, TagsInputInput, TagsInputItem, TagsInputItemDelete, TagsInputItemText } from '@/common/components/ui/tags-input';
import { useFilter } from 'reka-ui';
import { computed, ref } from 'vue';
const props = defineProps({
  options: {
    type: Array,
    default: () => [],
  },
  reduce: {
    type: Function,
    default: (option: any) => option,
  },
  getLabel: {
    type: Function,
    default: (option: any) => option,
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
  limit: {
    type: Number,
    required: false,
    default: 8000000000,
  },
});
const model = defineModel({
  default: [],
  type: Array<string>,
});
const open = ref(false);
const searchTerm = ref('');

const { contains } = useFilter({ sensitivity: 'base' });
const filteredFrameworks = computed(() => {
  const options = props.options.filter((i) => !model.value.includes(props.reduce(i)));
  return searchTerm.value ? options.filter((option) => contains(props.getLabel(option), searchTerm.value)) : options;
});

const selectElement = (ev) => {
  console.log(props.limit, model.value.length, model.value.length <= props.limit - 1);
  if (typeof ev.detail.value === 'string' && model.value.length <= props.limit - 1) {
    searchTerm.value = '';
    model.value.push(ev.detail.value);
  }

  if (filteredFrameworks.value.length === 0) {
    open.value = false;
  }
};
</script>

<template>
  <Combobox v-model="model" v-model:open="open" :ignore-filter="true">
    <ComboboxAnchor as-child>
      <TagsInput v-model="model" class="w-full gap-2 px-2">
        <div class="flex flex-wrap items-center gap-2">
          <TagsInputItem v-for="item in model" :key="item" :value="item">
            <TagsInputItemText />
            <TagsInputItemDelete />
          </TagsInputItem>
        </div>

        <ComboboxInput v-model="searchTerm" as-child>
          <TagsInputInput
            :placeholder="`${placeholder}...`"
            class="h-auto w-full min-w-[200px] border-none p-0 focus-visible:ring-0"
            @keydown.enter.prevent
          />
        </ComboboxInput>
      </TagsInput>

      <ComboboxList class="w-[--reka-popper-anchor-width]">
        <ComboboxEmpty />
        <ComboboxGroup>
          <ComboboxItem
            v-for="framework in filteredFrameworks"
            :key="props.reduce(framework)"
            :value="props.reduce(framework)"
            @select.prevent="selectElement"
          >
            {{ props.getLabel(framework) }}
          </ComboboxItem>
        </ComboboxGroup>
      </ComboboxList>
    </ComboboxAnchor>
  </Combobox>
</template>
