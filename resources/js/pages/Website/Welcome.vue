<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3';
import Footer from "@/pages/Website/partials/Footer.vue";
import Header from "@/pages/Website/partials/Header.vue";
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/"/>
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css"/>
    </Head>
    <Header/>
     [On Header [Explore properties]]
    <section class="bg-zinc-100">
        <div class="flex  flex-col items-start  max-w-screen-2xl mx-auto">
            - Promoted properties
             - [PropertyArticles] -> slider [show all]
            - New properties
             - [PropertyArticles] -> slider [show all]

            - Ads slider
               See footer of wander
               [slider images]
               [description]
            - Pick categories
               [ category ]
               [ category description ]
        </div>
    </section>

    <Footer/>
</template>
