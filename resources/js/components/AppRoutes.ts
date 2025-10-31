import type { NavItem } from '@/types';
import { FileWarning , LayoutGrid, Users,MapPinned ,Building2  } from 'lucide-vue-next';
import {t} from "@/lib/utils"

export const AppRoutes: NavItem[]  = [
    {
        title: t('dashboard'),
        href: route('dashboard'),
        icon: LayoutGrid,
        routeName: 'dashboard',
        adminOnly: false,
    },
    {
        title: t('Cities'),
        href: route('city.all'),
        icon: Building2 ,
        routeName: 'city.all',
        adminOnly: false,
    },
    {
        title: t('Provinces'),
        href: route('province.all'),
        icon: MapPinned  ,
        routeName: 'province.all',
        adminOnly: false,
    },
    {
        title: t('Condition'),
        href: route('condition.all'),
        icon: FileWarning   ,
        routeName: 'condition.all',
        adminOnly: false,
    },
    {
        title: t('Intermediation rules'),
        href: route('intermediation-rule.all'),
        icon: FileWarning   ,
        routeName: 'intermediation-rule.all',
        adminOnly: false,
    },
    {
        title: t('Neighborhood'),
        href: route('neighborhood.all'),
        icon: FileWarning   ,
        routeName: 'neighborhood.all',
        adminOnly: false,
    },
    {
        title: t('Property purpose'),
        href: route('property-purpose.all'),
        icon: FileWarning,
        routeName: 'property-purpose.all',
        adminOnly: false,
    },
    {
        title: t('Property type'),
        href: route('property-type.all'),
        icon: FileWarning,
        routeName: 'property-type.all',
        adminOnly: false,
    },
    {
        title: t('Transaction type'),
        href: route('transaction.type.all'),
        icon: FileWarning,
        routeName: 'transaction.type.all',
        adminOnly: false,
    },
    {
        title: t('Status'),
        href: route('status.all'),
        icon: FileWarning,
        routeName: 'status.all',
        adminOnly: false,
    },
];
