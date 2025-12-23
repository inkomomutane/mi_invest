<script setup lang="ts">

import NavBar from "@/pages/Website/partials/NavBar.vue";
import Hero from "@/pages/Website/partials/Hero.vue";
import Property from "@/components/Property.vue";
import Footer from "@/pages/Website/partials/Footer.vue";
import  image from "@/images/placeholder.svg"
</script>

<template>
    <NavBar/>

    <Hero class="min-h-102">
         <template #coverImage>
             <img :src="image"
                  alt="Sobre nós"  class="absolute object-cover inset-0 w-full h-full">
         </template>
    </Hero>
    <Footer/>
</template>
