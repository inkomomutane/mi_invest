<script setup lang="ts">

import {
    Dialog,
    DialogClose,
    DialogContent, DialogDescription,
    DialogFooter,
    DialogHeader, DialogScrollContent, DialogTitle
} from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';
import { EducationDto, UserDto } from '@/types/generated';
import { useForm } from '@inertiajs/vue3'
import { PropType } from "vue"

const props = defineProps({
    close: {
        type: Function,
        required: true,
    },
    openModal: {
        type: Boolean,
        required: true,
    },
    member: {
        type: Object as PropType<UserDto>,
        required: true,
    },
});

const form = useForm<UserDto>(props.education);

const submit =  () => {
    form.delete(route('prm-delete-member',{
        member : props.member?.id,
    }), {
        preserveState: true,
        onSuccess: () => {
            props.close();
        }
    })
}
</script>
<template>
    <Dialog  @update:open="props.close"  :open="props.openModal" class="z-200">
        <DialogScrollContent class="max-w-2xl" >
            <DialogHeader>
                <DialogTitle> {{$t('Delete')}}</DialogTitle>
            </DialogHeader>
            <DialogDescription>
                {{$t('Are you sure you want to delete this element?')}}
            </DialogDescription>
            <DialogFooter>
                <DialogClose as-child>
                    <Button variant="secondary">
                        {{$t('Cancel')}}
                    </Button>
                </DialogClose>
                <Button  @click="submit" variant="destructive">
                    {{$t('Delete')}}
                </Button>
            </DialogFooter>
        </DialogScrollContent>
    </Dialog>
</template>
