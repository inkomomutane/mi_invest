import {GraduationCap, LucideIcon} from 'lucide-vue-next';
import type { Config } from 'ziggy-js';
import {t} from "@/lib/utils";

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    routeName: string;
    href: string;
    icon?: LucideIcon;
    adminOnly?: boolean;
}

export interface PaginatedData {
    data: Array;
    links: Array;
   current_page?: number;
        first_page_url?: string;
        from?: number;
        last_page?: number;
        last_page_url?: string;
        next_page_url?: string;
        path?: string;
        per_page?: number;
        prev_page_url?: string;
        to?: number;
        total?: number;
}

export interface Cities extends Omit<PaginatedData, "data"> {
    data: Array<App.Data.CityData>;
    from?: number;
    to?: number;
    total?: number;
    links?: Array<{
        url?: string;
        label: string;
        active: boolean;
    }>;
    first_page_url?: string;
    last_page_url?: string;
    next_page_url?: string;
    prev_page_url?: string;
}

export interface Users extends Omit<PaginatedData, "data"> {
    data: Array<UserDto>;
    from?: number;
    to?: number;
    total?: number;
    links?: Array<{
        url?: string;
        label: string;
        active: boolean;
    }>;
    first_page_url?: string;
    last_page_url?: string;
    next_page_url?: string;
    prev_page_url?: string;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;
