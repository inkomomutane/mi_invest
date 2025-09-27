<script setup lang="ts" generic="T">
import type { ColumnTableDef } from '@/components/VTable/ColumnTableDef';
import { Table, TableBody, TableCell, TableFooter, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { cn, valueUpdater,t } from '@/lib/utils';
import { ChevronDown, CogIcon } from 'lucide-vue-next';
import {
    ColumnFiltersState,
    ExpandedState,
    FlexRender,
    getCoreRowModel,
    getExpandedRowModel,
    getFilteredRowModel,
    getPaginationRowModel,
    getSortedRowModel,
    SortingState,
    useVueTable,
    VisibilityState,
} from '@tanstack/vue-table';
import { ref } from 'vue';
import { DropdownMenu, DropdownMenuCheckboxItem, DropdownMenuContent, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { Button } from '@/components/ui/button';

interface Props {
    columnsDefs: Array<ColumnTableDef<T>>;
    pinning?: {
        left: Array<string>;
        right: Array<string>;
    };
}

const props = defineProps<Props>();
const disabledStyle = 'bg-muted  text-muted-foreground border-b dark:border-zinc-700';
const sorting = ref<SortingState>([]);
const columnFilters = ref<ColumnFiltersState>([]);
const columnVisibility = ref<VisibilityState>({});
const rowSelection = ref({});
const expanded = ref<ExpandedState>({});
const model = defineModel();

const table = useVueTable({
    data: model,
    get columns() {
        return props.columnsDefs;
    },
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    getSortedRowModel: getSortedRowModel(),
    getFilteredRowModel: getFilteredRowModel(),
    getExpandedRowModel: getExpandedRowModel(),
    onSortingChange: (updaterOrValue) => valueUpdater(updaterOrValue, sorting),
    onColumnFiltersChange: (updaterOrValue) => valueUpdater(updaterOrValue, columnFilters),
    onColumnVisibilityChange: (updaterOrValue) => valueUpdater(updaterOrValue, columnVisibility),
    onRowSelectionChange: (updaterOrValue) => valueUpdater(updaterOrValue, rowSelection),
    onExpandedChange: (updaterOrValue) => valueUpdater(updaterOrValue, expanded),
    state: {
        get sorting() {
            return sorting.value;
        },
        get columnFilters() {
            return columnFilters.value;
        },
        get columnVisibility() {
            return columnVisibility.value;
        },
        get rowSelection() {
            return rowSelection.value;
        },
        get expanded() {
            return expanded.value;
        },
        columnPinning: {
            left: props.pinning?.left ?? [],
            right: props.pinning?.right ?? [],
        },
    },
    manualPagination: true,
});
</script>
<template>
    <div class="mb-2 flex items-center justify-between px-2" v-if="false">
        <DropdownMenu>
            <DropdownMenuTrigger as-child>
                <Button variant="outline" class="ml-auto ">
                    <CogIcon class=""/>
                    <ChevronDown class="ml-2 h-4 w-4" />
                </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end">
                <DropdownMenuCheckboxItem
                    v-for="column in table.getAllColumns().filter((column) => column.getCanHide())"
                    :key="column.id"
                    class="capitalize"
                    :model-value="column.getIsVisible()"
                    @update:model-value="
            (value) => {
              column.toggleVisibility(!!value);
            }
          "
                >
                    {{ column.id }}
                </DropdownMenuCheckboxItem>
            </DropdownMenuContent>
        </DropdownMenu>
    </div>
    <Table class="">
        <TableHeader>
            <TableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
                <TableHead
                    v-for="header in headerGroup.headers"
                    :key="header.id"
                    :data-pinned="header.column.getIsPinned()"
                    :class="
            cn(
              {
                'sticky bg-white dark:bg-black': header.column.getIsPinned(),
              },
              header.column.getIsPinned() === 'left' ? 'left-0' : 'right-0',
            )
          "
                >
                    <FlexRender v-if="!header.isPlaceholder" :render="header.column.columnDef.header" :props="header.getContext()" />
                </TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <template v-if="table.getRowModel().rows?.length">
                <template v-for="row in table.getRowModel().rows" :key="row.id">
                    <TableRow :data-state="row.getIsSelected() && 'selected'">
                        <TableCell
                            v-for="cell in row.getVisibleCells()"
                            :key="cell.id"
                            :data-pinned="cell.column.getIsPinned()"
                            :class="
                cn(
                  'items-center p-1 text-sm',
                  {
                    'sticky z-10 bg-background': cell.column.getIsPinned(),
                  },
                  cell.column.getIsPinned() === 'left' ? 'left-0' : 'right-0',

                  cell.column.columnDef.meta?.disabled ? disabledStyle : '',
                )
              "
                        >
                            <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
                        </TableCell>
                    </TableRow>
                    <TableRow v-if="row.getIsExpanded()"> </TableRow>
                </template>
            </template>
            <TableRow v-else>
                <TableCell :colspan="columnsDefs.length" class="h-14 text-center">
                    {{ t('No items found') }}
                </TableCell>
            </TableRow>
            <slot name="footer"></slot>
            <TableRow>
                <TableCell> </TableCell>
            </TableRow>

        </TableBody>
    </Table>
</template>
