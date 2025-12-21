<script setup lang="ts">
import {
    Carousel,
    CarouselContent,
    CarouselItem,
    CarouselNext,
    CarouselPrevious,
} from '@/components/ui/carousel'
import Autoplay from 'embla-carousel-autoplay'
import { faker } from '@faker-js/faker';
import {NUMBER} from "@/lib/helpers";
const plugin = Autoplay({
    delay: 2000,
    stopOnMouseEnter: true,
    stopOnInteraction: false,
})

const amount  = faker.finance.amount({
     min: 1000,
    max:82000
});
const imageLoop = Array.from({ length: 9 }, () =>
    faker.image.urlPicsumPhotos())

</script>

<template>
    <div class="
        group
        relative
        isolate
        card-wrapper
        w-full
        space-y-3
        px-2  max-md:!snap-align-none
      " aria-label="Wander Kingsland Shores">
        <Carousel class="w-full rounded group-hover:scale-105 transition-all duration-300 transform-gpu "
                  :opts="{
                      align: 'start',
                      loop: true,
                    }"
        >
            <CarouselContent class="rounded">
                <CarouselItem v-for="image in imageLoop" :key="image" class="bg-zinc-200">
                    <img
                        alt="" loading="lazy" decoding="async"
                        class="animate-fade-in duration-300 h-[240px] w-full flex-none snap-center snap-always overflow-hidden object-cover rounded shadow-sm"
                        :srcset="image + ' 640w' + ','+ image + ' 1200w'"
                        :src="image">
                </CarouselItem>

            </CarouselContent>
            <CarouselPrevious  class="rounded-full bg-default absolute top-1/2 z-50 -translate-y-1/2 opacity-0 group-hover:opacity-100 pointer-events-auto hidden size-7 place-items-center text-primary backdrop-blur-xs md:grid border border-strong duration-200 transition-transform scale-100 hover:scale-[1.15] hover:border-strong-hover left-2"
            />
            <CarouselNext
                class="rounded-full bg-default absolute top-1/2 z-50 -translate-y-1/2 opacity-0 group-hover:opacity-100 pointer-events-auto hidden size-7 place-items-center text-primary backdrop-blur-xs md:grid border border-strong duration-200 transition-transform scale-100 hover:scale-[1.15] hover:border-strong-hover right-2"

            />
            <div class="flex max-w-[84px] items-center absolute bottom-0 left-1/2 z-40 -translate-x-1/2">
                <div class="flex h-4 w-full items-center overflow-x-hidden">
                    <div style="background-color: white; opacity: 0; width: 3px; height: 3px; margin: 3px;"></div>
                    <div style="background-color: white; opacity: 0; width: 3px; height: 3px; margin: 3px;"></div>
                    <div
                        style="margin: 3px; flex-shrink: 0; width: 4px; height: 4px; background-color: rgb(255, 255, 255); border-radius: 2px; opacity: 0.2;"></div>
                    <div
                        style="margin: 3px; flex-shrink: 0; width: 5px; height: 5px; background-color: rgb(255, 255, 255); border-radius: 2.5px; opacity: 0.2;"></div>
                    <div
                        style="margin: 3px; flex-shrink: 0; width: 6px; height: 6px; background-color: rgb(255, 255, 255); border-radius: 3px; opacity: 0.2;"></div>
                    <div
                        style="margin: 3px; flex-shrink: 0; width: 6px; height: 6px; background-color: rgb(255, 255, 255); border-radius: 3px; opacity: 0.2;"></div>
                    <div
                        style="margin: 3px; flex-shrink: 0; width: 6px; height: 6px; background-color: rgb(255, 255, 255); border-radius: 3px; opacity: 1;"></div>
                    <div
                        style="margin: 3px; flex-shrink: 0; width: 5px; height: 5px; background-color: rgb(255, 255, 255); border-radius: 2.5px; opacity: 0.2;"></div>
                    <div
                        style="margin: 3px; flex-shrink: 0; width: 4px; height: 4px; background-color: rgb(255, 255, 255); border-radius: 2px; opacity: 0.2;"></div>
                    <div
                        style="margin: 3px; flex-shrink: 0; width: 4px; height: 4px; background-color: rgb(255, 255, 255); border-radius: 2px; opacity: 0.2;"></div>
                    <div
                        style="margin: 3px; flex-shrink: 0; width: 4px; height: 4px; background-color: rgb(255, 255, 255); border-radius: 2px; opacity: 0.2;"></div>
                    <div
                        style="margin: 3px; flex-shrink: 0; width: 4px; height: 4px; background-color: rgb(255, 255, 255); border-radius: 2px; opacity: 0.2;"></div>
                    <div style="background-color: white; opacity: 0; width: 3px; height: 3px; margin: 3px;"></div>
                    <div style="background-color: white; opacity: 0; width: 3px; height: 3px; margin: 3px;"></div>
                </div>
            </div>
        </Carousel>






        <div class="">
            <div class="flex flex-row justify-between">
                <p class="font-bold text-[16px] text-[#202020] ">
                    {{ NUMBER(amount,2,'MZN').format() }}
                </p>
        </div>

            <div class="my-1 flex items-center gap-2 font-medium">
                <h3 class="text-headline-sm text-[#202020] font-medium truncate" data-slot="heading" title="Wander Kingsland Shores">
                    {{ faker.book.author() }}
                </h3>
            </div>
            <p class="text-xs font-light capitalize" data-slot="text">
                {{ faker.location.streetAddress()  + ', ' + faker.location.buildingNumber() }}
            </p>
            <div class="w-full flex items-center overflow-hidden gap-2">

            </div>
        </div>
    </div>
</template>
