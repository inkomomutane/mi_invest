<script setup lang="ts">
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogScrollContent,
    DialogTitle
} from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';
import { useForm } from '@inertiajs/vue3';
import { PropType } from 'vue';

const props = defineProps({
    close: {
        type: Function,
        required: true,
    },
    openModal: {
        type: Boolean,
        required: true,
    },
    transactionType: {
        type: Object as PropType<App.Data.TransactionTypeData>,
        required: true,
    },
});

const form = useForm({
    id: props.transactionType.id,
    name: props.transactionType.name,
});

const submit = () => {
    form.delete(route('transaction.type.delete', {
        transactionType: props.transactionType?.id,
    }), {
        preserveState: true,
        onSuccess: () => {
            props.close();
        }
    });
};
</script>

<template>
    <Dialog @update:open="props.close" :open="props.openModal" class="z-200">
        <DialogScrollContent class="max-w-2xl">
            <DialogHeader>
                <DialogTitle>{{ $t('Delete') }}</DialogTitle>
            </DialogHeader>
            <DialogDescription>
                {{ $t('Are you sure you want to delete this transaction type?') }}
                <div v-if="transactionType.icon?.original_url" class="mt-2">
                    <img
                        :src="transactionType.icon.original_url"
                        :alt="transactionType.name"
                        class="w-12 h-12 object-cover rounded border inline-block mr-2"
                    />
                    <strong>"{{ transactionType.name }}"</strong>
                </div>
            </DialogDescription>
            <DialogFooter>
                <DialogClose as-child>
                    <Button variant="secondary">
                        {{ $t('Cancel') }}
                    </Button>
                </DialogClose>
                <Button @click="submit" variant="destructive" :disabled="form.processing">
                    {{ form.processing ? $t('Deleting...') : $t('Delete') }}
                </Button>
            </DialogFooter>
        </DialogScrollContent>
    </Dialog>
</template>
