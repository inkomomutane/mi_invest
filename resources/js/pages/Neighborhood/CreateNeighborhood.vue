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
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import {crudManager, t} from "@/lib/utils";
import AsyncSelect from "@/components/Select/AsyncSelect.vue";
import {ref} from "vue";
import CreateCity from "@/pages/City/CreateCity.vue";

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
    city_id: null,
});
const crudManagerRef = ref(crudManager());

const submit = () => {
    form.post(route('neighborhood.store'), {
        preserveState: true,
        onSuccess: () => {
            props.close();
            form.reset();
        }
    });
};
</script>

<template>
    <Dialog @update:open="props.close" :open="props.openModal">
        <DialogScrollContent class="max-w-2xl">
            <DialogHeader>
                <DialogTitle>{{ $t('Add Neighborhood') }}</DialogTitle>
            </DialogHeader>
            <div>
                <form @submit.prevent="submit">
                    <div class="grid gap-4">
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('Neighborhood name') }}
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
                            <AsyncSelect
                                :placeholder="t('Select')"
                                :reduce="(option) => option.id"
                                :get-label="(option) => option.name"
                                :route-name="('cities-json')"
                                :mapper="item => ({
                                          id: item.id,
                                          title: item.name,
                                          subtitle:  '',
                                          slug:  '',
                                          notes:  '',
                                          trailer: '',
                                        })"
                                :create-new="() => crudManagerRef.open()"
                                v-model="form.city_id"
                            />
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
                    {{ $t('Save') }}
                </Button>
            </DialogFooter>
        </DialogScrollContent>
    </Dialog>
    <CreateCity  :close="crudManagerRef.close" :open-modal="crudManagerRef.isModalOpen" v-if="crudManagerRef.isModalOpen"  />
</template>
