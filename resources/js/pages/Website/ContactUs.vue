<script setup lang="ts">
import NavBar from "@/pages/Website/partials/NavBar.vue";
import Hero from "@/pages/Website/partials/Hero.vue";
import Property from "@/components/Property.vue";
import Footer from "@/pages/Website/partials/Footer.vue";
import  image from "@/images/placeholder.svg"

import { reactive } from 'vue'
import {Button} from "@/components/ui/button";
import {Field, FieldLabel} from "@/components/ui/field";
import {Input} from "@/components/ui/input";
import {Textarea} from "@/components/ui/textarea";

defineProps({
    globals: Object,
    success: String,
    error: String
})

const form = reactive({
    nome: '',
    email: '',
    contact: '',
    mensage: ''
})

const submit = () => {
    // connect Axios / Inertia here
    console.log(form)
}
</script>

<template>
    <NavBar/>
    <div class="h-102 ml-0 bg-zinc-100">
        <iframe
            class="w-screen ml-0 h-full z-40"
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3753.0770386572435!2d34.836501!3d-19.836693!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1f2a6b28c102d913%3A0xa02e05127dc570d!2zTWltw7N2ZWw!5e0!3m2!1spt-PT!2smz!4v1684070751499!5m2!1spt-PT!2smz"
            style="border: 0"
            allowfullscreen="true"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"> </iframe>
    </div>

    <section class="w-full grid grid-cols-10 bg-zinc-400">
        <!-- LEFT INFO -->
        <div
            class="hidden col-span-10 md:col-span-4 md:grid transition-transform  p-20 text-white font-semibold"
        >
            <!-- LOCATION -->
            <div class="mb-8 flex w-full max-w-[370px]">
                <div
                    class="mr-6 flex h-[60px] w-[60px] items-center justify-center rounded bg-white bg-opacity-10 sm:h-[70px] sm:w-[70px]"
                >
                    <!-- icon -->
                    <svg width="24" height="24" viewBox="0 0 24 24" class="fill-white">
                        <path d="M21.8182 24H16.5584C15.3896 24 14.4156 23.0256 14.4156 21.8563V17.5688C14.4156 17.1401 14.0649 16.7893 13.6364 16.7893H10.4026C9.97403 16.7893 9.62338 17.1401 9.62338 17.5688V21.8173C9.62338 22.9866 8.64935 23.961 7.48052 23.961H2.14286C0.974026 23.961 0 22.9866 0 21.8173V8.21437C0 7.62972 0.311688 7.08404 0.818182 6.77223L11.1039 0.263094C11.6494 -0.0876979 12.3896 -0.0876979 12.9351 0.263094L23.2208 6.77223C23.7273 7.08404 24 7.62972 24 8.21437V21.7783C24 23.0256 23.026 24 21.8182 24Z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="mb-1 text-xl font-bold uppercase">Localização</h4>
                    <p class="text-base">{{ globals?.location ?? '' }}</p>
                </div>
            </div>

            <!-- PHONE -->
            <div class="mb-8 flex w-full max-w-[370px]">
                <div
                    class="mr-6 flex h-[60px] w-[60px] items-center justify-center rounded bg-white bg-opacity-5 sm:h-[70px] sm:w-[70px]"
                >
                    <svg width="24" height="26" viewBox="0 0 24 26" class="fill-current">
                        <path d="M22.6149 15.1386..." />
                    </svg>
                </div>
                <div>
                    <h4 class="mb-1 text-xl font-bold uppercase">Telefone</h4>
                    <ul>
                        <li>(+258) 84/86 95 00 900</li>
                    </ul>
                </div>
            </div>

            <!-- EMAIL -->
            <div class="mb-8 flex w-full max-w-[370px]">
                <div
                    class="mr-6 flex h-[60px] w-[60px] items-center justify-center rounded bg-white bg-opacity-5 sm:h-[70px] sm:w-[70px]"
                >
                    <svg width="28" height="19" viewBox="0 0 28 19" class="fill-current">
                        <path d="M25.3636 0H2.63636..." />
                    </svg>
                </div>
                <div>
                    <h4 class="mb-1 text-xl font-bold uppercase">Email</h4>
                    <p>{{ globals?.email ?? '' }}</p>
                </div>
            </div>
        </div>

        <!-- RIGHT FORM -->
        <div class="col-span-10 md:col-span-6 px-6 py-16 md:p-20 bg-zinc-50">
            <!-- ALERTS -->
            <div
                v-if="success"
                class="flex p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50"
            >
                {{ success }}
            </div>

            <div
                v-if="error"
                class="flex p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50"
            >
                {{ error }}
            </div>

            <!-- FORM -->
            <form @submit.prevent="submit">
                <div class="grid gap-4 grid-cols-1 md:grid-cols-2 text-sm">
                    <Field>
                        <FieldLabel>Teu nome <span class="text-red-500">*</span></FieldLabel>
                        <Input v-model="form.nome" class="rounded-none border-2 border-zinc-800" />
                    </Field>

                    <Field>
                        <FieldLabel>Email</FieldLabel>
                        <Input v-model="form.email" class="rounded-none border-2 border-zinc-800" />
                    </Field>

                    <Field class="md:col-span-2">
                        <FieldLabel>Contacto</FieldLabel>
                        <Input v-model="form.contact" class="rounded-none border-2 border-zinc-800" />
                    </Field>

                    <Field class="md:col-span-2">
                        <FieldLabel>Mensagem</FieldLabel>
                        <Textarea v-model="form.mensage" rows="5" class="rounded-none border-2 border-zinc-800"></Textarea>
                    </Field>

                    <Field class="md:col-span-2">
                        <Button class=" text-white py-5 w-full font-bold rounded-none">
                            Enviar mensage
                        </Button>
                    </Field>
                </div>
            </form>
        </div>
    </section>
    <Footer/>
</template>
