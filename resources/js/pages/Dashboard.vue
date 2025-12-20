<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import SyncSelect from "@/components/Select/SyncSelect.vue";
import AsyncSelect from "@/components/Select/AsyncSelect.vue";
import Icon from "@/components/Icon.vue";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">


            <AsyncSelect :route-name="('icon-set-list')" :reduce="(e) => e.id"  >
                 <template #option-trailer="{ option }">
                    <div class="text-xs font-semibold text-foreground">
                        <Icon :lab="option.lab" :name="option.title" :size="40" class="me-1 inline-block !w-6 !h-6" aria-hidden="true" />
                     </div>
                 </template>

                 <template #selected-option="{ selectedValue }">
                    <div class="flex items-center gap-2" v-if="selectedValue">
                        <Icon :lab="selectedValue.lab" :name="selectedValue.title" :size="40" class="me-1 inline-block !w-6 !h-6" aria-hidden="true" />
                        <span class="font-medium">{{ selectedValue.title }}</span>
                    </div>
                 </template>
            </AsyncSelect>


            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">



                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
