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
import { PropType, ref } from 'vue';
import InputError from '@/components/InputError.vue';

const props = defineProps({
    propertyType: {
        type: Object as PropType<App.Data.PropertyTypeData>,
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
    id: props.propertyType.id,
    name: props.propertyType.name,
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
    form.patch(
        route('property-type.update', {
            propertyType: props.propertyType.id as number,
        }),
        {
            preserveState: true,
            onSuccess: () => {
                props.close();
                form.reset();
                if (fileInput.value) {
                    fileInput.value.value = '';
                }
            }
        }
    );
};
</script>

<template>
    <Dialog @update:open="props.close" :open="props.openModal">
        <DialogScrollContent class="max-w-2xl">
            <DialogHeader>
                <DialogTitle>{{ $t('Edit Property Type') }}</DialogTitle>
            </DialogHeader>
            <div>
                <form @submit.prevent="submit">
                    <div class="grid gap-4">
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('Property Type Name') }}
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

                        <div v-if="propertyType.icon?.original_url" class="grid w-full items-center gap-1.5">
                            <Label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('Current Icon') }}
                            </Label>
                            <img
                                :src="propertyType.icon.original_url"
                                :alt="propertyType.name"
                                class="w-16 h-16 object-cover rounded border"
                            />
                        </div>

                        <div class="grid w-full items-center gap-1.5">
                            <Label for="images" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('New Icons') }} ({{ $t('Optional') }})
                            </Label>
                            <Input
                                ref="fileInput"
                                id="images"
                                type="file"
                                multiple
                                accept="image/*"
                                @change="handleFileChange"
                                class="w-full"
                            />
                            <p class="text-sm text-gray-500">{{ $t('Select new icon images to replace or add (max 15MB each)') }}</p>
                            <InputError :message="form.errors.images" class="mt-2" />
                        </div>

                        <div v-if="form.images.length > 0" class="grid gap-2">
                            <Label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('New Files Selected') }}:
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
                    {{ form.processing ? $t('Updating...') : $t('Update') }}
                </Button>
            </DialogFooter>
        </DialogScrollContent>
    </Dialog>
</template>
