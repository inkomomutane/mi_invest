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
import { PropType } from 'vue';
import InputError from '@/components/InputError.vue';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

const props = defineProps({
    neighborhood: {
        type: Object as PropType<App.Data.NeighborhoodData>,
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
    cities: {
        type: Array<App.Data.CityData>,
        required: true,
    },
});

const form = useForm({
    id: props.neighborhood.id,
    name: props.neighborhood.name,
    city_id: props.neighborhood.city?.id,
});

const submit = () => {
    form.patch(
        route('neighborhood.update', {
            neighborhood: props.neighborhood.id as number,
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
                <DialogTitle>{{ $t('Edit Neighborhood') }}</DialogTitle>
            </DialogHeader>
            <div>
                <form @submit.prevent="submit">
                    <div class="grid gap-4">
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('Neighborhood Name') }}
                            </Label>
                            <Input
                                id="name"
                                type="text"
                                v-model="form.name"
                                class="w-full"
                                :placeholder="$t('Enter neighborhood name')"
                                required
                            />
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>
                        
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="city" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('City') }}
                            </Label>
                            <Select v-model="form.city_id">
                                <SelectTrigger class="w-full">
                                    <SelectValue :placeholder="$t('Select City')" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectItem :value="city.id" v-for="city in props.cities" :key="city.id">
                                            {{ city.name }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <InputError :message="form.errors.city_id" class="mt-2" />
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