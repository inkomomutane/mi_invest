<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { h, PropType, ref, watch } from 'vue';
import { Users } from '@/types';
import { Card, CardContent, CardFooter, CardHeader } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { PencilIcon, Search, Trash2 } from 'lucide-vue-next';
import { Button, buttonVariants } from '@/components/ui/button';
import Pagination from '@/components/Pagination.vue';
import Heading from '@/components/Heading.vue';
import { crudManager, t } from '@/lib/utils';
import { KeyValueDto, UserDto } from '@/types/generated';
import Create from './Create.vue';
import Edit from '@/pages/Members/Edit.vue';
import { createColumnHelper } from '@tanstack/vue-table';
import VTable from '@/components/VTable/VTable.vue';
import VHeader from '@/components/VTable/VHeader.vue';
import VCell from '@/components/VTable/VCell.vue';
import Delete from './Delete.vue';

const props = defineProps({
    members: {
        type: Object as PropType<Users>,
        required: true,
    },
    sex: Array<KeyValueDto>,
    marital_status: Array<KeyValueDto>,
    patents: Array<KeyValueDto>,
});

const searchTerm = ref('');
watch(searchTerm, (value) => {
    router.visit(
        route('prm-members', {
            search: value ?? '',
        }),
        {
            only: ['members'],
            replace: true,
            preserveState: true,
        },
    );
});

const crudManagerRef = ref(crudManager<UserDto>());
const editManagerRef = ref(crudManager<UserDto>());
const deleteManagerRef = ref(crudManager<UserDto>());

const tableData = ref<UserDto[]>([]);
watch(
    () => props.members?.data,
    (newData) => {
        tableData.value = newData ?? [];
    },
    { immediate: true, deep: true },
);

const columnHelper = createColumnHelper<UserDto>();
const columns = [
    columnHelper.accessor('name', {
        header: ({ column }) => h(VHeader, { column, title: t('Name') }),
        cell: (info) => h(VCell, { cell: info, value: info.getValue() }),
    }),
    columnHelper.accessor('email', {
        header: ({ column }) => h(VHeader, { column, title: t('Email') }),
        cell: (info) => h(VCell, { cell: info, value: info.getValue() }),
    }),
    columnHelper.accessor('nip', {
        header: ({ column }) => h(VHeader, { column, title: t('NIP') }),
        cell: (info) => h(VCell, { cell: info, value: info.getValue() }),
    }),
    columnHelper.accessor('phone', {
        header: ({ column }) => h(VHeader, { column, title: t('Phone') }),
        cell: (info) => h(VCell, { cell: info, value: info.getValue() }),
    }),
    columnHelper.accessor('sex', {
        header: ({ column }) => h(VHeader, { column, title: t('Sex') }),
        cell: (info) => h(VCell, { cell: info, value: (info.getValue()) }),
    }),
    columnHelper.accessor('marital_status', {
        header: ({ column }) => h(VHeader, { column, title: t('Marital Status') }),
        cell: (info) => h(VCell, { cell: info, value:  (info.getValue()) }),
    }),
    columnHelper.display({
        id: 'actions',
        header: () => t('Actions'),
        cell: ({ row }) =>
            h('div', { class: 'flex items-center space-x-2' }, [
                h(
                    Link,
                    {
                        variant: 'ghost',
                        size: 'sm',
                        href: route('member.edit-base-info',{
                            member: row.original.id,
                        }),
                        class: buttonVariants({
                            variant: 'ghost',
                            size: 'sm',
                        })
                    },
                    () => h(PencilIcon, { class: 'h-4 w-4' }),
                ),
                h(
                    Button,
                    {
                        variant: 'ghost',
                        size: 'sm',
                        class: 'text-red-500 hover:text-red-600',
                        onClick: () => deleteManagerRef.value.open(row.original),
                    },
                    () => h(Trash2, { class: 'h-4 w-4' }),
                ),
            ]),
    }),
];
</script>

<template>
    <Head :title="$t('Members')" />
    <AppLayout>
        <Card class="mt-0 rounded-none bg-white px-4 pt-6 shadow-none dark:bg-zinc-950">
            <Heading class="mb-2 pb-0" :title="$t('Members')" :description="$t('Members')" />
        </Card>
         <div class="mx-auto max-w-screen-xl">
            <div class="mx-auto flex h-full max-w-7xl flex-1 flex-col gap-4 rounded-xl">
                <Card class="rounded-[1px] shadow-none">
                    <CardHeader class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                        <div class="relative w-full max-w-sm items-center">
                            <Input v-model="searchTerm" id="search" type="text" :placeholder="$t('Search') + '...'" class="pl-10" />
                            <span class="absolute inset-y-0 start-0 flex items-center justify-center px-2">
                                <Search class="size-4 text-muted-foreground" />
                            </span>
                        </div>
                        <div class="flex w-full shrink-0 flex-col items-stretch justify-end space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0">
                            <Button @click="crudManagerRef.open(null)">
                                {{ $t('Add') }}
                            </Button>
                        </div>
                    </CardHeader>
                    <CardContent class="p-0">
                        <VTable v-model="tableData" :columns-defs="columns" />
                    </CardContent>
                    <CardFooter class="p-0">
                        <Pagination
                            :from="members?.from"
                            :to="members.to"
                            :total="members.total"
                            :links="members?.links"
                            :first_page_url="members?.first_page_url"
                            :last_page_url="members?.last_page_url"
                            :next_page_url="members.next_page_url"
                            :prev_page_url="members?.prev_page_url"
                            class="p-4"
                        />
                    </CardFooter>
                </Card>
            </div>
        </div>
    </AppLayout>
    <Create v-if="crudManagerRef.isModalOpen" :patents="patents" :sex="sex" :marital_status="marital_status" :openModal="crudManagerRef.isModalOpen" :close="crudManagerRef.close" />
    <Edit
        v-if="editManagerRef.isModalOpen"
        :sex="sex"
        :patents="patents"
        :marital_status="marital_status"
        :openModal="editManagerRef.isModalOpen"
        :close="editManagerRef.close"
        :member="editManagerRef.model"
    />

    <Delete
        v-if="deleteManagerRef.isModalOpen"
        :openModal="deleteManagerRef.isModalOpen"
        :close="deleteManagerRef.close"
        :member="deleteManagerRef.model"
    />
   </template>
