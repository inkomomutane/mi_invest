<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3';
import Footer from "@/pages/Website/partials/Footer.vue";
import Header from "@/pages/Website/partials/Header.vue";
import {Card, CardContent} from "@/components/ui/card";
import {Item, ItemContent, ItemDescription, ItemGroup, ItemHeader, ItemTitle} from "@/components/ui/item";
import { AspectRatio } from '@/components/ui/aspect-ratio'
import {Badge} from "@/components/ui/badge";
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/"/>
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css"/>
    </Head>
    <Header/>
    <section class="bg-[#efefef]">
        <div class="flex  flex-col items-start  max-w-screen-2xl mx-auto  pb-6 pt-10 md:py-10 sm:px-6 lg:px-16">
            <h2 class="tracking-tight dark:text-gray-50 font-bold  uppercase border-l-2   border-l-black dark:border-white/50 pl-2 my-4">
                Promoted properties
            </h2>
            <ItemGroup class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 mt-3">
                <Item
                    as-child
                    v-for="i in [1,2,3,4]"
                    role="listitem"
                    class="bg-white [a]:hover:bg-white/90"
                >
                    <a href="#" class=" ">
                        <ItemHeader >
                            <img

                                src="https://mimovel.com/storage/hotels/4804/responsive-images/1000871152___media_library_original_489_310.jpg"

                                class=" w-full rounded-sm object-cover  min-h-48"
                            >
                        </ItemHeader>
                        <ItemContent>
                            <ItemTitle class="flex flex-col justify-start items-start">
                               <div class="flex flex-row justify-between w-full">
                                   <span class="text-xl">265,000.00 &nbsp;€</span>

                               </div>
                                <p>
                                    T2 Remodelado junto a Loja do Cidadão do Porto
                                </p>
                            </ItemTitle>
                            <ItemDescription>
                                <span class="text-[9pt] ">
                                    Rua Vasques de Mesquita, Antas - São Roque, Campanhã, Porto, Porto
                                </span>
                            </ItemDescription>
                        </ItemContent>
                    </a>
                </Item>
            </ItemGroup>
            <h2 class="tracking-tight dark:text-gray-50 font-bold  uppercase border-l-2   border-l-black dark:border-white/50 pl-2 my-4">
                New properties
            </h2>
            <ItemGroup class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 mt-3">
                <Item
                    as-child
                    v-for="i in [1,2,3,4]"
                    role="listitem"
                    class="bg-white [a]:hover:bg-white/90"
                >
                    <a href="#" class=" ">
                        <ItemHeader >
                            <img
                                src="https://mimovel.com/storage/hotels/4804/responsive-images/1000871152___media_library_original_489_310.jpg"
                                class=" w-full rounded-sm object-cover  max-h-[540px]"
                            >
                        </ItemHeader>
                        <ItemContent>
                            <ItemTitle class="flex flex-col justify-start items-start">
                                <span class="text-xl">265,000.00 &nbsp;€</span>
                                <p>
                                    T2 Remodelado junto a Loja do Cidadão do Porto
                                </p>
                            </ItemTitle>
                            <ItemDescription>
                                <span class="text-sm ">
                                    Rua Vasques de Mesquita, Antas - São Roque, Campanhã, Porto, Porto
                                </span>
                            </ItemDescription>
                        </ItemContent>
                    </a>
                </Item>
            </ItemGroup>
            <h2 class="tracking-tight dark:text-gray-50 font-bold  uppercase border-l-2   border-l-black dark:border-white/50 pl-2 my-4">
                Publicidade
            </h2>
            <ItemGroup class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 mt-3">
                <Item
                    as-child
                    v-for="i in [1,2,3,4]"
                    role="listitem"
                    class="bg-white [a]:hover:bg-white/90"
                >
                    <a href="#" class=" ">
                        <ItemHeader >
                            <img
                                src="https://ireland.apollo.olxcdn.com/v1/files/eyJmbiI6IjhyM251MXk4eWMxZzEtRUNPU1lTVEVNIiwidyI6W3siZm4iOiI2OW5scGE3ZWNxbTcxLUFQVCIsInMiOiIxNCIsInAiOiIxMCwtMTAiLCJhIjoiMCJ9XX0.tiNUnDPTGmgY6KYnArvaF0gz4eOjXSv-Kigu7Urk9KQ/image;s=1280x1024;q=80"
                                class=" w-full rounded-sm object-cover  max-h-[540px]"
                            >
                        </ItemHeader>
                        <ItemContent>
                            <ItemTitle class="flex flex-col justify-start items-start">
                                <p>
                                    T2 Remodelado junto a Loja do Cidadão do Porto
                                </p>
                            </ItemTitle>
                        </ItemContent>
                    </a>
                </Item>
            </ItemGroup>
        </div>
    </section>

    <Footer/>
</template>
