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
    propertyPurpose: {
        type: Object as PropType<App.Data.PropertyPurposeData>,
        required: true,
    },
});

const form = useForm({
    id: props.propertyPurpose.id,
    name: props.propertyPurpose.name,
});

const submit = () => {
    form.delete(route('property-purpose.delete', {
        propertyPurpose: props.propertyPurpose?.id,
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
                {{ $t('Are you sure you want to delete this property purpose?') }}
            </DialogDescription>
            <DialogFooter>
                <DialogClose as-child>
                    <Button variant="secondary">
                        {{ $t('Cancel') }}
                    </Button>
                </DialogClose>
                <Button @click="submit" variant="destructive">
                    {{ $t('Delete') }}
                </Button>
            </DialogFooter>
        </DialogScrollContent>
    </Dialog>
</template>