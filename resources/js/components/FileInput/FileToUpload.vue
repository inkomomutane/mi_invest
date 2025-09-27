<script setup lang="ts">
import { calcFileSize } from './concerns';
import FileTypePreview from './FileTypePreview.vue';
import { cn } from '@/lib/utils';

withDefaults(
    defineProps<{
        file: File;
        status?: 'pending' | 'invalid' | 'success';
        error?: string;
    }>(),
    {
        status: 'pending',
        error: '',
    },
);

defineEmits(['deleteFile']);
</script>

<template>
    <div
        :class="
      cn('rounded-md border bg-zinc-100 dark:bg-zinc-900', {
        'border-red-500': status === 'invalid',
        'border-green-500': status === 'success',
        'border-orange-500 dark:border-orange-700': status === 'pending',
      })
    "
    >
        <div class="flex w-full items-center space-x-4">
            <div class="shrink-0">
                <FileTypePreview :file="file" />
            </div>
            <div class="hidden flex-1 sm:block sm:w-64">
                <p class="truncate text-justify text-sm font-medium">
                    {{ file.name }}
                </p>
            </div>
            <div class="min-w-fit flex-1">
                <p class="truncate text-sm font-bold">
                    {{ calcFileSize(file.size) }}
                </p>
            </div>
            <div class="min-w-0 flex-1"></div>
            <div class="inline-flex items-center text-base font-semibold">
        <span class="relative flex h-3 w-3">
          <span
              :class="
              cn('absolute inline-flex h-full w-full animate-ping rounded-full opacity-75', {
                'bg-green-500': status === 'success',
                'bg-orange-500 dark:bg-orange-700': status === 'pending',
                'bg-red-500': status === 'invalid',
              })
            "
          ></span>
          <span
              :class="
              cn('relative inline-flex h-3 w-3 rounded-full', {
                'bg-green-500': status === 'success',
                'bg-orange-500 dark:bg-orange-700': status === 'pending',
                'bg-red-500': status === 'invalid',
              })
            "
          ></span>
        </span>
            </div>
            <button class="px-4" @click="$emit('deleteFile', file)">
                <svg
                    aria-hidden="true"
                    class="h-5 w-5 text-gray-500 hover:text-red-500"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        clip-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        fill-rule="evenodd"
                    ></path>
                </svg>
            </button>
        </div>
        <div v-if="status === 'invalid'" class="border-t border-red-500 bg-red-100/10 px-4 py-2 text-sm font-medium text-red-500 dark:bg-red-600/10">
            {{ error }}
        </div>
    </div>
</template>
