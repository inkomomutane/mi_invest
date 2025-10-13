<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter, SidebarGroup,
    SidebarGroupLabel,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem
} from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import {Link, usePage} from '@inertiajs/vue3';
import { BookOpen, Folder } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { AppRoutes } from '@/components/AppRoutes';
import {computed,ref} from "vue"
import {cn} from "@/lib/utils";

const isCurrentRoute = computed(() => (routeName: string) => route().current(routeName ?? ''));

const activeItemStyles = computed(() => (routeName: string) => (isCurrentRoute.value(routeName) ? 'border-l-slate-950 bg-slate-950/10   dark:border-l-white dark:bg-white/10' : ''),
);

const mainNavItems: NavItem[] = ref(AppRoutes);
const page = usePage();


</script>

<template>
    <Sidebar collapsible="icon" variant="sidebar">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <SidebarGroup class="px-2 py-0">
                <SidebarGroupLabel>Mi - Invest</SidebarGroupLabel>
                <SidebarMenu>
                    <SidebarMenuItem v-for="item in mainNavItems" :key="item.title" >
                        <SidebarMenuButton as-child :is-active="item.href === page.url" :tooltip="item.title" >
                            <Link :href="item.href"
                                  :class="cn('!rounded-none outline-l-4 ',activeItemStyles(item.routeName))"
                            >
                                <component :is="item.icon" />
                                <span>{{ item.title }}</span>
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarGroup>
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
