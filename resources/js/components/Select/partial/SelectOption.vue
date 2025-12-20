<script setup lang="ts">
import type {SelectOptionType} from '@/components/Select/partial/SelectOptionType';
import {Badge} from '@/components/ui/badge';
import {cn} from '@/lib/utils';
import {defineProps, PropType} from 'vue';

const props = defineProps({
    option: {
        type: Object as PropType<SelectOptionType>,
        default: () => {
            return {
                id: '',
                title: '',
                subtitle: '',
                slug: '',
                notes: '',
                trailer: '',
            };
        },
    },
    class: {
        type: String,
        default: '',
    },
    selected: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <div
        v-if="props.option"
        :class="
      cn(
        'flex w-full cursor-pointer flex-row items-center justify-between border-l-4 p-2 py-3 text-sm font-medium transition-colors duration-200',
        {
          'border-zinc-600 bg-zinc-100 dark:border-white dark:bg-zinc-900': props.selected,
          'border-transparent': !props.selected,
        },
        [
          'hover:bg-zinc-100 dark:hover:bg-zinc-900',
          'focus:bg-zinc-100 dark:focus:bg-zinc-900',
          '!min-w-72',
          'border-b border-b-gray-200/80 dark:border-b-zinc-900/90',
        ],
        props.class,
      )
    "
    >
        <div class="flex w-full flex-row items-center justify-between gap-4">
            <div class="flex w-full flex-col">
                <div class="flex w-full flex-row items-center justify-between gap-2">
                    <Badge variant="secondary"
                           class="rounded-sm border border-gray-950/10 bg-transparent text-xs dark:border-gray-100/10">
                        {{ props.option.slug }}
                    </Badge>
                </div>
                <div class="mt-1 flex flex-col gap-1">
        <span
            :class="
            cn('line-clamp-2 font-medium first-letter:uppercase', {
              'font-bold': props.selected,
            })
          "
        >
          {{ props.option.title }}
        </span>
                    <span>
                      <span class="line-clamp-2 max-w-md text-sm text-muted-foreground">
                        {{ props.option.notes }}
                      </span>
                    </span>
                </div>
            </div>
            <div class="text-xs font-semibold text-foreground">
                  <slot name="trailer" :props="props.option">
                    {{ props.option.trailer ?? '' }}
                  </slot>
        </div>
        </div>
    </div>


</template>
