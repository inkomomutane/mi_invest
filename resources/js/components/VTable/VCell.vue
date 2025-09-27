<script setup lang="ts">
const props = defineProps({
    cell: {
        type: Object,
        required: true,
    },
    value: {
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
    <div :class="['flex items-center justify-between ps-4', props.class]">
        <span class="text-sm font-medium text-muted-foreground first-letter:uppercase">{{ props.value }}</span>
    </div>
</template>
