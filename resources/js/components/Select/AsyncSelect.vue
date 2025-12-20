<script setup lang="ts" generic="T">
import { Button } from '@/components/ui/button';
import { Command, CommandEmpty, CommandGroup, CommandInput, CommandList, CommandSeparator } from '@/components/ui/command';
import { Popover, PopoverAnchor, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { Separator } from '@/components/ui/separator';
import { Skeleton } from '@/components/ui/skeleton';
import SelectOption from '@/components/Select/partial/SelectOption.vue';
import { SelectOptionType } from '@/components/Select/partial/SelectOptionType';
import { cn,t } from '@/lib/utils';
import { useDebounceFn } from '@vueuse/core';
import { ChevronDown, Plus } from 'lucide-vue-next';
import { ListboxItem } from 'reka-ui';
import { ulid } from 'ulidx';
import { PropType, computed, onMounted, ref, watch } from 'vue';
import { ValidRouteName } from 'ziggy-js';

const props = defineProps({
  placeholder: {
    type: String,
    default: t('Select'),
  },
  routeName: {
    type: Object as PropType<ValidRouteName>,
    required: true,
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
    align: {
      type: String,
        default: 'start'
    },
  mapper: {
    type: Function as PropType<(item: T) => SelectOptionType>,
    default: (item: T): SelectOptionType => ({
      id: item.id,
      title: item.title,
      subtitle: item.subtitle || '',
      slug: item.slug || '',
      notes: item.notes || '',
      trailer: item.trailer,
    }),
  },
  selectedKey: {
    type: String,
    default: 'id',
  },
  createNew: {
    type: Function,
    required: false,
    default: () => {
      console.warn('Create new function not provided');
    },
  },
});

const emit = defineEmits(['value:selected', 'value:deselected']);

const open = ref(false);
const searchQuery = ref('');
const options = ref<T[]>([]);
const loading = ref(false);
const abortController = ref<AbortController | null>(null);

const fetchCounties = async (search: string = ''): Promise<{ data: T[] }> => {
  if (abortController.value) {
    abortController.value.abort();
  }
  abortController.value = new AbortController();
  const signal = abortController.value.signal;

  const url = route(props.routeName, {
    search: search,
    selected_key: props.selectedKey,
    selected_value: model.value,
  });

  try {
    const response = await fetch(url, { signal: signal });

    if (!response.ok) {
      console.error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();

    return {
      data: data,
    };
  } catch (error: any) {
    if (error.name === 'AbortError') {
      console.log('Fetch aborted');
      // Return empty data on abort
    } else {
      console.error('Fetch error:', error);
      throw error; // Re-throw other errors
    }
    return { data: [] };
  } finally {
    abortController.value = null;
  }
};
const loadCounties = async () => {
  loading.value = true;
  try {
    const { data } = await fetchCounties(searchQuery.value);
    options.value = data.map((item) => ({
      ...item,
      _uniqueKey: item.id || ulid().toString().toLowerCase(),
    }));
  } catch (error) {
    console.error('Error loading options:', error);
  } finally {
    loading.value = false;
  }
};

const debouncedSearch = useDebounceFn(() => {
  loadCounties();
}, 300);

watch(searchQuery, () => {
  debouncedSearch();
});

onMounted(() => {
  loadCounties();
});

const model = defineModel();

const selectedValue = computed(() => {
  return options.value.find((option) => props.reduce(option) === model.value) ?? null;
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

const handleSelect = (item: T) => {

    if (selectedValue.value && props.reduce(item) === props.reduce(selectedValue.value)) {
        model.value = null;
        emit('value:deselected', item);
        return;
    }

  open.value = false;
  searchQuery.value = '';
  model.value = props.reduce(item) ;
};

watch(open, (isOpen) => {
  if (isOpen) {
    searchQuery.value = '';
    loadCounties();
  }
});

watch(() => model.value, () => {
    if (!selectedValue.value) {
        loadCounties()
    }
});


</script>

<template>
  <Popover v-model:open="open">
      <div class="flex flex-row">
          <PopoverTrigger as-child>
              <slot name="trigger">
                  <Button
                      id="select-42"
                      variant="outline"
                      role="combobox"
                      :disabled="disabled"
                      :aria-expanded="open"
                      class="w-full min-w-40 justify-between bg-background px-3 font-normal hover:bg-background cursor-pointer"
                  >
                        <slot name="selected-option" :selectedValue="selectedValue">
                             <span :class="cn('truncate')">
                                {{ selectedValue ? getLabel(selectedValue) : placeholder }}
                        </span>
                        </slot>
                      <ChevronDown :size="16" :stroke-width="2" class="shrink-0 text-muted-foreground/80" aria-hidden="true" />
                  </Button>
              </slot>
          </PopoverTrigger>
      </div>

    <PopoverContent class="w-full min-w-[var(--reka-popper-anchor-width)] p-0" :align="align">
      <Command class="w-full">
        <CommandInput :placeholder="placeholder" v-model="searchQuery" />
        <CommandGroup>
          <Button variant="ghost" class="w-full cursor-pointer justify-start rounded-xs font-normal" @click="createNew">
            <Plus :size="16" :stroke-width="2" class="me-2 opacity-60" aria-hidden="true" />
            {{ t('Add new') }}
          </Button>
        </CommandGroup>
        <CommandSeparator />
        <CommandList>
          <CommandEmpty v-if="!loading && options.length === 0">
            {{ t('No items found.') }}
          </CommandEmpty>
          <ListboxItem
            v-for="option in options"
            :key="option._uniqueKey"
            :class="
              cn(
                `relative flex cursor-default items-center gap-2 rounded-sm text-sm outline-hidden select-none data-[disabled=true]:pointer-events-none data-[disabled=true]:opacity-50 data-[highlighted]:bg-accent data-[highlighted]:text-accent-foreground [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4 [&_svg:not([class*='text-'])]:text-muted-foreground`,
                props.class,
              )
            "
            @select="handleSelect(option)"
          >
            <SelectOption :option="props.mapper(option)" :selected="selectedValue === option" >
                <template #trailer="{ props: option }">
                     <slot name="option-trailer" :option="option">
                        {{ option.trailer ?? '' }}
                     </slot>
                </template>
            </SelectOption>
          </ListboxItem>
          <Separator />
          <div v-if="loading" class="gapy-4 flex w-full flex-col items-start space-x-4 p-4">
            <div class="w-full space-y-2">
              <div class="flex flex-row justify-between">
                <Skeleton class="h-2 w-[25px]" />
                <Skeleton class="h-2 w-[25px]" />
              </div>
              <Skeleton class="h-2 w-[250px]" />
              <Skeleton class="h-2 w-[200px]" />
              <Skeleton class="h-1.5 w-[20px]" />
            </div>
          </div>
          <!-- End of results indicator -->
          <div v-if="options.length > 0 && !loading" class="flex items-center justify-center p-2">
            <span class="text-xs text-muted-foreground">
              {{ t('No more items found.') }}
            </span>
          </div>
        </CommandList>
      </Command>
    </PopoverContent>
  </Popover>
</template>
