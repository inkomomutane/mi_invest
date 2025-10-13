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
import InputError from '@/components/InputError.vue';
import { ref } from 'vue';

const props = defineProps({
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
    name: '',
    images: [] as File[],
});

const fileInput = ref<HTMLInputElement>();

const handleFileChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files) {
        form.images = Array.from(target.files);
    }
};

const submit = () => {
    form.post(route('property-type.store'), {
        preserveState: true,
        onSuccess: () => {
            props.close();
            form.reset();
            if (fileInput.value) {
                fileInput.value.value = '';
            }
        }
    });
};
</script>

<template>
    <Dialog @update:open="props.close" :open="props.openModal">
        <DialogScrollContent class="max-w-2xl">
            <DialogHeader>
                <DialogTitle>{{ $t('Add Property Type') }}</DialogTitle>
            </DialogHeader>
            <div>
                <form @submit.prevent="submit">
                    <div class="grid gap-4">
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('Property type name') }}
                            </Label>
                            <Input
                                id="name"
                                type="text"
                                v-model="form.name"
                                class="w-full"
                                :placeholder="$t('Enter property type name')"
                                required
                            />
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>

                        <div class="grid w-full items-center gap-1.5">
                            <Label for="images" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('Icons') }}
                            </Label>
                            <Input
                                ref="fileInput"
                                id="images"
                                type="file"
                                multiple
                                accept="image/*"
                                @change="handleFileChange"
                                class="w-full"
                                required
                            />
                            <p class="text-sm text-gray-500">{{ $t('Select one or more icon images (max 15MB each)') }}</p>
                            <InputError :message="form.errors.images" class="mt-2" />
                        </div>

                        <div v-if="form.images.length > 0" class="grid gap-2">
                            <Label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('Selected Files') }}:
                            </Label>
                            <ul class="text-sm text-gray-600">
                                <li v-for="(file, index) in form.images" :key="index">
                                    {{ file.name }} ({{ Math.round(file.size / 1024) }}KB)
                                </li>
                            </ul>
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
                <Button @click="submit" :disabled="form.processing">
                    {{ form.processing ? $t('Saving...') : $t('Save') }}
                </Button>
            </DialogFooter>
        </DialogScrollContent>
    </Dialog>
</template>
