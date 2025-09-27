import type { ColumnDef } from '@tanstack/vue-table';

export function ColumnTableDef<T>(config: {
    header: string;
    accessorKey: keyof T;
    cell?: (value: any) => string | Component;
    headerClass?: string;
    cellClass?: string;
}): ColumnDef<T> {
    return {
        accessorKey: config.accessorKey as string,
        header: () => config.header,
        cell: ({ row }) => (config.cell ? config.cell(row.getValue(config.accessorKey)) : row.getValue(config.accessorKey)),
        meta: {
            class: {
                header: config.headerClass,
                cell: config.cellClass,
            },
        },
    };
}
