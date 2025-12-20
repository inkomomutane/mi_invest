<script setup lang="ts">

import AppLogoIcon from "@/components/AppLogoIcon.vue";
import {Input} from "@/components/ui/input";
import NavBar from "@/pages/Website/partials/NavBar.vue";
import {InputGroup, InputGroupAddon, InputGroupInput} from "@/components/ui/input-group";
import { Search} from "lucide-vue-next"
</script>

<template>
    <NavBar/>
    <header class="relative w-full text-white">

        <img
            src="https://images.unsplash.com/photo-1628133287836-40bd5453bed1?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
            alt="gradient pattern" class="absolute inset-0 w-full h-full object-cover"/>
        <div class="absolute   inset-0 bg-black opacity-80"></div>
        <div class="relative">
            <div class=" mx-auto bg-background/10">


            </div>

            <div class="max-w-screen-2xl py-8 md:py-16 lg:py-24 mx-auto">

                <div class="">

                    <h1 class="font-sans antialiased font-bold text-3xl md:text-4xl lg:text-5xl text-current [text-wrap:_balance] max-w-3xl mx-auto mb-6 text-center !leading-tight">
                        Our company mission is to lead the web development.</h1>
                     <div class="mx-auto  min-w-40 max-w-screen-lg h-72 ">
                         <div class="w-full h-full bg-white px-16">
                             <InputGroup>
                                 <InputGroupInput placeholder="Search..." class="" />
                                 <InputGroupAddon>
                                     <Search />
                                 </InputGroupAddon>
                                 <InputGroupAddon align="inline-end">
                                     12 results
                                 </InputGroupAddon>
                             </InputGroup>
                         </div>
                     </div>
                </div>

            </div>
        </div>
    </header>
</template>

<style scoped>

</style>
