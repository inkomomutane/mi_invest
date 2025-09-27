<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { ArrowDownWideNarrow, ArrowUpNarrowWide } from 'lucide-vue-next';
import { cn } from '@/lib/utils';

const props = defineProps({
    column: {
        type: Object,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    class: {
        type: String,
        default: '',
    }
});
</script>

<template>
     <slot name="header">
         <Button
             variant="ghost"
             :class="cn('w-full justify-between rounded-none border-none text-muted-foreground capitalize hover:bg-transparent',props.class)"
             @click="column.toggleSorting(column.getIsSorted() === 'asc')"
         >
             {{ title }}
             <ArrowUpNarrowWide v-if="column.getIsSorted() === 'asc'" class="ml-2 h-4 w-12" />
             <ArrowDownWideNarrow v-else-if="column.getIsSorted() === 'desc'" class="ml-2 h-4 w-12" />
         </Button>
     </slot>
</template>
