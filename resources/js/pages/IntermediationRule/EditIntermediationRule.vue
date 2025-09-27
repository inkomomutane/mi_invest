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
import {
    NumberField,
    NumberFieldContent,
    NumberFieldDecrement,
    NumberFieldIncrement,
    NumberFieldInput
} from "@/components/ui/number-field";

const props = defineProps({
    intermediationRule: {
        type: Object as PropType<App.Data.IntermediationRuleData>,
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
    id: props.intermediationRule.id,
    name: props.intermediationRule.name,
    code: props.intermediationRule.code,
    percentage: props.intermediationRule.percentage,
});

const submit = () => {
    form.patch(
        route('intermediation-rule.update', {
            intermediationRule: props.intermediationRule.id as number,
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
                <DialogTitle>{{ $t('Edit Intermediation Rule') }}</DialogTitle>
            </DialogHeader>
            <div>
                <form @submit.prevent="submit">
                    <div class="grid gap-4">
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $t('Intermediation Rule Name') }}
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
                                :placeholder="$t('Enter code')"
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
                    {{ $t('Update') }}
                </Button>
            </DialogFooter>
        </DialogScrollContent>
    </Dialog>
</template>
