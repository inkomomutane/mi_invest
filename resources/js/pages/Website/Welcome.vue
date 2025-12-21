<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3';
import Footer from "@/pages/Website/partials/Footer.vue";
import Header from "@/pages/Website/partials/Header.vue";
import {Card, CardContent} from "@/components/ui/card";
import {Item, ItemContent, ItemDescription, ItemGroup, ItemHeader, ItemTitle} from "@/components/ui/item";
import { AspectRatio } from '@/components/ui/aspect-ratio'
import {Badge} from "@/components/ui/badge";
import Property from "@/components/Property.vue";
import {Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious} from "@/components/ui/carousel";
import { ChevronRight,ChevronLeft } from 'lucide-vue-next';
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/"/>
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css"/>
    </Head>
    <Header/>
    <section class="">
        <div class="flex  flex-col items-start  max-w-screen-3xl mx-auto  p-6 pt-10 md:py-10 sm:px-6 lg:px-24 space-y-12">
            <Carousel
                class="relative w-full"
                :opts="{
                    align: 'start',
                    loop: true,
                    dragFree: false,
                     watchDrag : false
                    }"
                >
                <div class="flex flex-row justify-between items-center my-4">
                    <div class="flex">
                        <h2 class="tracking-tight dark:text-gray-50 font-bold  uppercase border-l-2   border-l-black dark:border-white/50 pl-2 ">
                            Promoted properties

                        </h2>
                        <ChevronRight class="opacity-50"/>
                    </div>
                    <div>
                        <CarouselPrevious class="translate-x-0 top-auto left-auto right-9 shadow-none " >
                             <ChevronLeft/>
                        </CarouselPrevious>
                        <CarouselNext class="translate-x-0 top-auto left-auto right-0 shadow-none" >
                            <ChevronRight/>
                        </CarouselNext>
                    </div>
                </div>
                <CarouselContent>
                    <CarouselItem v-for="(_, index) in 9" :key="index" class="basis-1/2 md:basis-1/3 lg:basis-1/4 xl:basis-1/5 2xl:basis-1/6">
                        <Property/>
                    </CarouselItem>
                </CarouselContent>

            </Carousel>
            <Carousel
                class="relative w-full"
                :opts="{
                    align: 'start',
                    loop: true,
                    dragFree: false,
                     watchDrag : false
                    }"
            >
                <div class="flex flex-row justify-between items-center my-4">
                    <div class="flex">
                        <h2 class="tracking-tight dark:text-gray-50 font-bold  uppercase border-l-2   border-l-black dark:border-white/50 pl-2 ">
                            New properties
                        </h2>
                        <ChevronRight class="opacity-50"/>
                    </div>
                    <div>
                        <CarouselPrevious class="translate-x-0 top-auto left-auto right-9 shadow-none " >
                            <ChevronLeft/>
                        </CarouselPrevious>
                        <CarouselNext class="translate-x-0 top-auto left-auto right-0 shadow-none" >
                            <ChevronRight/>
                        </CarouselNext>
                    </div>
                </div>
                <CarouselContent>
                    <CarouselItem v-for="(_, index) in 9" :key="index" class="basis-1/2 md:basis-1/3 lg:basis-1/4 xl:basis-1/5 2xl:basis-1/6">
                        <Property/>
                    </CarouselItem>
                </CarouselContent>

            </Carousel>
            <Carousel
                class="relative w-full"
                :opts="{
                    align: 'start',
                    loop: true,
                    dragFree: false,
                     watchDrag : false
                    }"
            >
                <div class="flex flex-row justify-between items-center my-4">
                    <div class="flex">
                        <h2 class="tracking-tight dark:text-gray-50 font-bold  uppercase border-l-2   border-l-black dark:border-white/50 pl-2 ">
                            Publicidade
                        </h2>
                        <ChevronRight class="opacity-50"/>
                    </div>
                    <div>
                        <CarouselPrevious class="translate-x-0 top-auto left-auto right-9 shadow-none " >
                            <ChevronLeft/>
                        </CarouselPrevious>
                        <CarouselNext class="translate-x-0 top-auto left-auto right-0 shadow-none" >
                            <ChevronRight/>
                        </CarouselNext>
                    </div>
                </div>
                <CarouselContent>
                    <CarouselItem v-for="(_, index) in 9" :key="index" class="basis-1/2 md:basis-1/3 lg:basis-1/4 xl:basis-1/5 2xl:basis-1/6">
                        <Property/>
                    </CarouselItem>
                </CarouselContent>

            </Carousel>
        </div>
    </section>

    <Footer/>
</template>
