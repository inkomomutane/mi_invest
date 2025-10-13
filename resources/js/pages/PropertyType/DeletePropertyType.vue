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
    propertyType: {
        type: Object as PropType<App.Data.PropertyTypeData>,
        required: true,
    },
});

const form = useForm({
    id: props.propertyType.id,
    name: props.propertyType.name,
});

const submit = () => {
    form.delete(route('property-type.delete', {
        propertyType: props.propertyType?.id,
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
                {{ $t('Are you sure you want to delete this property type?') }}
                <div v-if="propertyType.icon?.original_url" class="mt-2">
                    <img
                        :src="propertyType.icon.original_url"
                        :alt="propertyType.name"
                        class="w-12 h-12 object-cover rounded border inline-block mr-2"
                    />
                    <strong>"{{ propertyType.name }}"</strong>
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
