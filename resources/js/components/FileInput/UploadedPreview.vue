<script setup lang="ts">
import { calcFileSize } from './concerns';
import { cn } from '@/lib/utils';
import { FileData } from './concerns';
import { PropType } from 'vue';
import { fileType, FILETYPES } from './concerns';

const props = defineProps({
    file: {
        type: Array<FileData>,
        required: true,
    },
});

const defaultStyle = 'shadow-2 h-16 object-cover p-1';
</script>

<template>
    <template v-for="(file,index) in props.file" :key="index" >
        <a target="_attachment" :href="file.url" class="my-2 flex w-fit items-center space-x-4 rounded-sm border bg-zinc-800 text-white dark:bg-zinc-950">
            <div class="shrink-0">
                <img
                    v-if="fileType(file) === FILETYPES.IMAGE"
                    :alt="file.name"
                    :class="defaultStyle"
                    :src="file.url"
                    height="50"
                    role="presentation"
                    width="100"
                />
                <div
                    v-else-if="fileType(file) === FILETYPES.PDF"
                    :class="cn(defaultStyle, 'flex items-center justify-center rounded-sm bg-rose-500 text-white')"
                >
                    <svg height="40" width="50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="none">
                        <path
                            d="M9 16C8.44772 16 8 16.4477 8 17V21.9999C8 22.5522 8.44772 22.9999 9 22.9999C9.55228 22.9999 10 22.5522 10 21.9999V21H10.5C11.8807 21 13 19.8807 13 18.5C13 17.1193 11.8807 16 10.5 16H9ZM10.5 19H10V18H10.5C10.7761 18 11 18.2239 11 18.5C11 18.7761 10.7761 19 10.5 19ZM14 17C14 16.4477 14.4477 16 15 16H15.5C17.433 16 19 17.567 19 19.5C19 21.433 17.433 23 15.5 23H15C14.7348 23 14.4804 22.8946 14.2929 22.7071C14.1054 22.5196 14 22.2652 14 22V17ZM16 20.9146C16.5826 20.7087 17 20.1531 17 19.5C17 18.8469 16.5826 18.2913 16 18.0854V20.9146ZM20 21.9999V17C20 16.4477 20.4477 16 21 16H24C24.5523 16 25 16.4477 25 17C25 17.5523 24.5523 18 24 18H22V19H24C24.5523 19 25 19.4477 25 20C25 20.5523 24.5523 21 24 21H22V21.9999C22 22.5522 21.5523 22.9999 21 22.9999C20.4477 22.9999 20 22.5522 20 21.9999ZM6 5V13H5C3.89543 13 3 13.8954 3 15V24C3 25.1046 3.89543 26 5 26H6V27C6 28.6569 7.34315 30 9 30H23C24.6569 30 26 28.6569 26 27V26H27C28.1046 26 29 25.1046 29 24V15C29 13.8954 28.1046 13 27 13H26V9.82843C26 9.03278 25.6839 8.26972 25.1213 7.70711L20.2929 2.87868C19.7303 2.31607 18.9672 2 18.1716 2H9C7.34315 2 6 3.34315 6 5ZM9 4H16V9C16 10.6569 17.3431 12 19 12H24V13H8V5C8 4.44772 8.44772 4 9 4ZM8 27V26H24V27C24 27.5523 23.5523 28 23 28H9C8.44772 28 8 27.5523 8 27ZM24 9.82843V10H19C18.4477 10 18 9.55228 18 9V4H18.1716C18.4368 4 18.6911 4.10536 18.8787 4.29289L23.7071 9.12132C23.8946 9.30886 24 9.56321 24 9.82843ZM5 15H27V24H5V15Z"
                            fill="currentColor"
                        ></path>
                    </svg>
                </div>
                <div v-else :class="cn(defaultStyle, 'flex items-center justify-center rounded-sm bg-rose-500 text-white')">
                    <svg width="50" height="40" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z"></path>
                        <path
                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"
                        ></path>
                    </svg>
                </div>
            </div>
            <div class="hidden flex-1 sm:block sm:w-64">
                <p class="truncate text-justify text-sm font-medium text-gray-50 dark:text-white">
                    {{ file.name }}
                </p>
            </div>
            <div class="min-w-fit flex-1">
                <p class="truncate text-sm font-medium text-gray-50 dark:text-white">
                    {{ calcFileSize(file.size) }}
                </p>
            </div>
            <div class="min-w-0 flex-1"></div>
            <div class="inline-flex items-center pr-3 text-base font-semibold text-gray-900 dark:text-white">
                <div role="status">
                    <svg
                        class="fillCurrent text-green-500 dark:text-green-50"
                        fill="none"
                        height="24"
                        viewBox="0 0 24 24"
                        width="24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            class="fill-green-400 dark:fill-green-50"
                            d="M12.8956 13.4982L10.7949 11.2651C10.2697 10.7068 9.38251 10.7068 8.85731 11.2651C8.37559 11.7772 8.37559 12.5757 8.85731 13.0878L12.7499 17.2257C13.1448 17.6455 13.8118 17.6455 14.2066 17.2257L21.1427 9.85252C21.6244 9.34044 21.6244 8.54191 21.1427 8.02984C20.6175 7.47154 19.7303 7.47154 19.2051 8.02984L14.061 13.4982C13.7451 13.834 13.2115 13.834 12.8956 13.4982Z"
                            opacity="0.5"
                        />
                        <path
                            class="fill-green-500 dark:fill-green-50"
                            d="M7.89557 13.4982L5.79487 11.2651C5.26967 10.7068 4.38251 10.7068 3.85731 11.2651C3.37559 11.7772 3.37559 12.5757 3.85731 13.0878L7.74989 17.2257C8.14476 17.6455 8.81176 17.6455 9.20663 17.2257L16.1427 9.85252C16.6244 9.34044 16.6244 8.54191 16.1427 8.02984C15.6175 7.47154 14.7303 7.47154 14.2051 8.02984L9.06096 13.4982C8.74506 13.834 8.21146 13.834 7.89557 13.4982Z"
                        />
                    </svg>
                </div>
            </div>
        </a>
    </template>
</template>
