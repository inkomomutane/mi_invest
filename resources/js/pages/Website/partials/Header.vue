<script setup lang="ts">

import AppLogoIcon from "@/components/AppLogoIcon.vue";
import {Input} from "@/components/ui/input";
</script>

<template>
    <header class="relative w-full text-white">

        <img
            src="https://images.unsplash.com/photo-1628133287836-40bd5453bed1?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
            alt="gradient pattern" class="absolute inset-0 w-full h-full object-cover"/>
        <div class="absolute   inset-0 bg-black opacity-80"></div>
        <div class="relative">
            <div class=" mx-auto bg-background/10">

                <!-- Navbar -->

                <nav
                    class="max-w-screen-2xl mx-auto rounded-lg border shadow-lg overflow-hidden p-2  border-transparent shadow-transparent px-0">

                    <div class="flex items-center relative">

                        <a href="#" class="font-sans antialiased text-sm text-current block py-1 font-semibold">
                            <AppLogoIcon class-name="w-16" />
                        </a>

                        <!-- Desktop Menu -->

                        <div class="hidden lg:block absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">

                            <ul class="mt-4 flex flex-col gap-x-3 gap-y-1.5 lg:mt-0 lg:flex-row lg:items-center">

                                <li>

                                    <a href="#"
                                       class="font-sans antialiased text-sm text-current p-1 hover:text-primary">Home</a>

                                </li>

                                <li>

                                    <a href="#"
                                       class="font-sans antialiased text-sm text-current p-1 hover:text-primary">Services</a>

                                </li>

                                <li>

                                    <a href="#"
                                       class="font-sans antialiased text-sm text-current p-1 hover:text-primary">About</a>

                                </li>

                                <li>

                                    <a href="#"
                                       class="font-sans antialiased text-sm text-current p-1 hover:text-primary">Contact</a>

                                </li>

                            </ul>

                        </div>

                        <!-- Sign In / Sign Up Buttons (Desktop Only) -->

                        <div class="hidden lg:ml-auto lg:flex items-center gap-2">

                            <button
                                class="inline-flex items-center justify-center border align-middle select-none font-sans font-medium text-center transition-all duration-300 ease-in text-sm rounded-md py-1.5 px-3 bg-transparent border-stone-200 text-stone-800 hover:bg-stone-100 hover:border-stone-300">
                                Sign In
                            </button>

                            <button
                                class="inline-flex items-center justify-center border align-middle select-none font-sans font-medium text-center duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:cursor-not-allowed focus:shadow-none text-sm py-2 px-4 shadow-sm hover:shadow-md bg-stone-800 hover:bg-stone-700 relative bg-gradient-to-b from-stone-700 to-stone-800 border-stone-900 text-stone-50 rounded-lg hover:bg-gradient-to-b hover:from-stone-800 hover:to-stone-800 hover:border-stone-900 after:absolute after:inset-0 after:rounded-[inherit] after:box-shadow after:shadow-[inset_0_1px_0px_rgba(255,255,255,0.25),inset_0_-2px_0px_rgba(0,0,0,0.35)] after:pointer-events-none transition antialiased">
                                Sign Up
                            </button>

                        </div>

                        <!-- Mobile Menu Button -->

                        <button onClick="toggleMenu()"
                                class="place-items-center border align-middle select-none font-sans font-medium text-center transition-all duration-300 ease-in text-sm min-w-[34px] min-h-[34px] rounded-md bg-transparent border-stone-200 text-stone-800 hover:bg-stone-100 hover:border-stone-300 shadow-none hover:shadow-none ml-auto grid lg:hidden">

                            <svg width="1.5em" height="1.5em" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg" color="currentColor" class="h-4 w-4">

                                <path d="M3 5H21" stroke="currentColor" stroke-linecap="round"
                                      stroke-linejoin="round"></path>

                                <path d="M3 12H21" stroke="currentColor" stroke-linecap="round"
                                      stroke-linejoin="round"></path>

                                <path d="M3 19H21" stroke="currentColor" stroke-linecap="round"
                                      stroke-linejoin="round"></path>

                            </svg>

                        </button>

                    </div>

                    <!-- Mobile Menu Content -->

                    <div class="hidden lg:hidden mt-2">

                        <ul class="flex flex-col gap-y-2 p-4 bg-white rounded-lg">

                            <li>

                                <a href="#"
                                   class="font-sans antialiased text-sm text-gray-800 block hover:text-primary">Home</a>

                            </li>

                            <li>

                                <a href="#"
                                   class="font-sans antialiased text-sm text-gray-800 block hover:text-primary">Services</a>

                            </li>

                            <li>

                                <a href="#"
                                   class="font-sans antialiased text-sm text-gray-800 block hover:text-primary">About</a>

                            </li>

                            <li>

                                <a href="#"
                                   class="font-sans antialiased text-sm text-gray-800 block hover:text-primary">Contact</a>

                            </li>

                            <li>

                                <a href="#"
                                   class="font-sans antialiased text-sm text-gray-800 block hover:text-primary">Sign
                                    In</a>

                            </li>

                            <li>

                                <a href="#"
                                   class="font-sans antialiased text-sm text-gray-800 block hover:text-primary">Sign
                                    Up</a>

                            </li>

                        </ul>

                    </div>

                </nav>

            </div>

            <div class="max-w-screen-2xl py-8 md:py-16 lg:py-24 mx-auto">

                <div class="mb-12 md:mb-24">

                    <h1 class="font-sans antialiased font-bold text-3xl md:text-4xl lg:text-5xl text-current [text-wrap:_balance] max-w-3xl mx-auto mb-6 text-center !leading-tight">
                        Our company mission is to lead the web development.</h1>

                    <p class="font-sans antialiased text-base md:text-lg text-stone-600 mb-12 mx-auto text-center max-w-xl">
                        The time is now for it to be okay to be great. People in this world shun people for being great.
                        For being a bright color.</p>
                </div>
            </div>
        </div>
    </header>
</template>

<style scoped>

</style>
