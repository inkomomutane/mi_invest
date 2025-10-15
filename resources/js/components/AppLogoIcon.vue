<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import logo from "@/images/logo.jpg"

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <img :src="logo" alt="Mi invest" :class="className" />
</template>
