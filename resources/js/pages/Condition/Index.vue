<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { h, PropType, ref, watch } from 'vue';
import { Card, CardContent, CardFooter, CardHeader } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { PencilIcon, Search, Trash2 } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import Pagination from '@/components/Pagination.vue'
import { crudManager, t } from '@/lib/utils';
import Create from './CreateCondition.vue';
import Edit from './EditCondition.vue';
import { createColumnHelper } from '@tanstack/vue-table';
import VTable from '@/components/VTable/VTable.vue';
import VHeader from '@/components/VTable/VHeader.vue';
import VCell from '@/components/VTable/VCell.vue';
import Delete from './DeleteCondition.vue';

const props = defineProps({
    conditions: {
        type: Object,
        required: true,
    },
    search: String,
    messages: Object as PropType<FlasherResponse>,
});

const searchTerm = ref('');
watch(searchTerm, (value) => {
    router.visit(
        route('condition.all', {
            search: value ?? '',
        }),
        {
            only: ['conditions'],
            replace: true,
            preserveState: true,
        },
    );
});

const crudManagerRef = ref(crudManager<App.Data.ConditionData>());
const editManagerRef = ref(crudManager<App.Data.ConditionData>());
const deleteManagerRef = ref(crudManager<App.Data.ConditionData>());

const tableData = ref<App.Data.ConditionData[]>([]);
watch(
    () => props.conditions?.data,
    (newData) => {
        tableData.value = newData ?? [];
    },
    { immediate: true, deep: true },
);

const columnHelper = createColumnHelper<App.Data.ConditionData>();
const columns = [
    columnHelper.accessor('id', {
        header: ({ column }) => h(VHeader, { column, title: t('ID') }),
        cell: (info) => h(VCell, { cell: info, value: info.getValue() }),
    }),
    columnHelper.accessor('name', {
        header: ({ column }) => h(VHeader, { column, title: t('Condition name') }),
        cell: (info) => h(VCell, { cell: info, value: info.getValue() }),
    }),
    columnHelper.display({
        id: 'actions',
        header: () => t('Actions'),
        cell: ({ row }) =>
            h('div', { class: 'flex items-center space-x-2' }, [
                h(
                    Button,
                    {
                        variant: 'ghost',
                        size: 'sm',
                        onClick: () => editManagerRef.value.open(row.original),
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
    <Head :title="$t('Conditions')" />
    <AppLayout>

        <div class="">
            <div class="mx-auto flex h-full flex-1 flex-col gap-4 rounded-xl">
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
                            :from="conditions?.from"
                            :to="conditions.to"
                            :total="conditions.total"
                            :per_page="conditions.per_page"
                            :links="conditions?.links"
                            :first_page_url="conditions?.first_page_url"
                            :last_page_url="conditions?.last_page_url"
                            :next_page_url="conditions.next_page_url"
                            :prev_page_url="conditions?.prev_page_url"
                            class="p-4"
                        />
                    </CardFooter>
                </Card>
            </div>
        </div>
    </AppLayout>
    <Create v-if="crudManagerRef.isModalOpen" :openModal="crudManagerRef.isModalOpen" :close="crudManagerRef.close" />
    <Edit
        v-if="editManagerRef.isModalOpen"
        :openModal="editManagerRef.isModalOpen"
        :close="editManagerRef.close"
        :condition="editManagerRef.model"
    />
    <Delete
        v-if="deleteManagerRef.isModalOpen"
        :openModal="deleteManagerRef.isModalOpen"
        :close="deleteManagerRef.close"
        :condition="deleteManagerRef.model"
    />
</template>
