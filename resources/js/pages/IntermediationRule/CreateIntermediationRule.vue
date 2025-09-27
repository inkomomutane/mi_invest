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
import {
    NumberField,
    NumberFieldContent,
    NumberFieldDecrement,
    NumberFieldIncrement,
    NumberFieldInput,
} from "@/components/ui/number-field"

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
    code: '',
    percentage: '',
});

const submit = () => {
    form.post(route('intermediation-rule.store'), {
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
                <DialogTitle>{{ $t('Add Intermediation Rule') }}</DialogTitle>
            </DialogHeader>
            <div>
                <form @submit.prevent="submit">
                    <div class="grid gap-4">
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('Intermediation Rule name') }}
                            </Label>
                            <Input
                                id="name"
                                type="text"
                                v-model="form.name"
                                class="w-full"
                                :placeholder="$t('Enter intermediation rule name')"
                                required
                            />
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="code" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('Code') }}
                            </Label>
                            <Input
                                id="code"
                                type="text"
                                v-model="form.code"
                                class="w-full font-mono"
                                :placeholder="$t('Enter code (e.g., INT, COM, etc.)')"
                                required
                            />
                            <InputError :message="form.errors.code" class="mt-2" />
                        </div>
                        <div class="grid w-full items-center gap-1.5">
                            <NumberField id="percentage"  v-model="form.percentage" :default-value="0" :min="0" :max="100" step="0.01" class="w-full">
                                <Label for="percentage">
                                    {{ $t('Percentage') }}
                                </Label>
                                <NumberFieldContent>
                                    <NumberFieldDecrement />
                                    <NumberFieldInput />
                                    <NumberFieldIncrement />
                                </NumberFieldContent>
                            </NumberField>
                            <InputError :message="form.errors.percentage" class="mt-2" />
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
</template>
