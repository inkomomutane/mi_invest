<script setup lang="ts">
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogFooter,
    DialogHeader,
    DialogScrollContent,
    DialogTitle
} from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { useForm } from '@inertiajs/vue3';
import { PropType, watch } from 'vue';
import InputError from '@/components/InputError.vue';

const props = defineProps({
    propertyPurpose: {
        type: Object as PropType<App.Data.PropertyPurposeData>,
        required: true,
    },
    close: {
        type: Function,
        required: true,
    },
    openModal: {
        type: Boolean,
        required: true,
    },
});

const form = useForm({
    id: props.propertyPurpose.id,
    name: props.propertyPurpose.name,
    slug_text: props.propertyPurpose.slug_text,
});

// Auto-generate slug from name when name changes
watch(() => form.name, (newName) => {
    if (newName) {
        const autoSlug = newName
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();

        // Only update if user hasn't manually changed the slug
        if (!form.slug_text || form.slug_text === autoSlug) {
            form.slug_text = autoSlug;
        }
    }
});

const submit = () => {
    form.patch(
        route('property-purpose.update', {
            propertyPurpose: props.propertyPurpose.id as number,
        }),
        {
            preserveState: true,
            onSuccess: () => {
                props.close();
                form.reset();
            }
        }
    );
};
</script>

<template>
    <Dialog @update:open="props.close" :open="props.openModal">
        <DialogScrollContent class="max-w-2xl">
            <DialogHeader>
                <DialogTitle>{{ $t('Edit Property Purpose') }}</DialogTitle>
            </DialogHeader>
            <div>
                <form @submit.prevent="submit">
                    <div class="grid gap-4">
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('Property Purpose Name') }}
                            </Label>
                            <Input
                                id="name"
                                type="text"
                                v-model="form.name"
                                class="w-full"
                                :placeholder="$t('Enter property purpose name')"
                                required
                            />
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="slug_text" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('Slug') }}
                            </Label>
                            <Input
                                id="slug_text"
                                type="text"
                                v-model="form.slug_text"
                                class="w-full font-mono"
                                :placeholder="$t('Enter slug')"
                                required
                            />
                            <InputError :message="form.errors.slug_text" class="mt-2" />
                            <p class="text-sm text-muted-foreground">
                                {{ $t('Slug is auto-generated from name but you can edit it') }}
                            </p>
                        </div>
                    </div>
                </form>
            </div>
            <DialogFooter>
                <DialogClose as-child>
                    <Button variant="secondary">
                        {{ $t('Cancel') }}
                    </Button>
                </DialogClose>
                <Button @click="submit">
                    {{ $t('Update') }}
                </Button>
            </DialogFooter>
        </DialogScrollContent>
    </Dialog>
</template>
