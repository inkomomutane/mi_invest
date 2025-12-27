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
import {PropType, ref} from 'vue';
import InputError from '@/components/InputError.vue';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import {crudManager, t} from "@/lib/utils"
import CreateProvince from "@/pages/Province/CreateProvince.vue";
import AsyncSelect from "@/components/Select/AsyncSelect.vue";
const props = defineProps({
    city: {
        type: Object as PropType<App.Data.CityData>,
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

const crudManagerRef = ref(crudManager());

const form = useForm({
    id: props.city.id,
    name: props.city.name,
    province_id: props.city.province?.id,
});

const submit = () => {
    form.patch(
        route('city.update', {
            city: props.city.id as number,
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
                <DialogTitle>{{ $t('Edit City') }}</DialogTitle>
            </DialogHeader>
            <div>
                <form @submit.prevent="submit">
                    <div class="grid gap-4">
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="nome" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('City Name') }}
                            </Label>
                            <Input
                                id="nome"
                                type="text"
                                v-model="form.name"
                                class="w-full"
                                :placeholder="$t('Enter city name')"
                                required
                            />
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>

                        <div class="grid w-full items-center gap-1.5">
                            <Label for="province" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('Province') }}
                            </Label>
                            <AsyncSelect
                                :placeholder="t('Select')"
                                :reduce="(option) => option.id"
                                :get-label="(option) => option.name"
                                :route-name="('provinces-json')"
                                :mapper="item => ({
                                          id: item.id,
                                          title: item.name,
                                          subtitle:  '',
                                          slug:  '',
                                          notes:  '',
                                          trailer: '',
                                        })"
                                :create-new="() => crudManagerRef.open()"
                                v-model="form.province_id"
                            />
                            <InputError :message="form.errors.province_id" class="mt-2" />
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

    <CreateProvince  :close="crudManagerRef.close" :open-modal="crudManagerRef.isModalOpen" v-if="crudManagerRef.isModalOpen"  />
</template>
