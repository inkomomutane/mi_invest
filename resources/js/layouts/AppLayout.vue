<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import { usePage } from '@inertiajs/vue3';
import type { BreadcrumbItemType } from '@/types';
import flasher from "@flasher/flasher";
import {onMounted, watch} from "vue";
interface Props {
    breadcrumbs?: BreadcrumbItemType[];
    messages?: string[];
}

const props = withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});



watch(() => props.messages, (msg) => {
    if (msg && msg.length > 0) {
        flasher.render(msg);
    }
}, { immediate: true });


onMounted(() => {
    if (props.messages) {
        flasher.render(messages);
    }
});

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
            <div class="max-w-9xl mx-auto w-full px-4 py-8 sm:px-6 lg:px-12">
      <div class="overflow-hidden">
         <div class="grid grid-cols-1">
                  <div class="p-4 md:px-8">
                <slot />
        </div>
         </div>
        </div>
        </div>
    </AppLayout>
</template>
