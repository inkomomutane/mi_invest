<script setup lang="ts">

import AppLogoIcon from "@/components/AppLogoIcon.vue";
import {Input} from "@/components/ui/input";
import NavBar from "@/pages/Website/partials/NavBar.vue";
import {InputGroup, InputGroupAddon, InputGroupInput} from "@/components/ui/input-group";
import { Search} from "lucide-vue-next"
import {cn, t} from "@/lib/utils";
import AsyncSelect from "@/components/Select/AsyncSelect.vue";
import SyncSelect from "@/components/Select/SyncSelect.vue";
import {NumberField, NumberFieldContent, NumberFieldInput} from "@/components/ui/number-field";
import {useForm} from "@inertiajs/vue3";
import {FieldLabel} from "@/components/ui/field";
import {Label} from "@/components/ui/label";
import {Button} from "@/components/ui/button";
const form = useForm({
    min_area: null,
    max_are: null,
    min_price: null,
    max_price: null,
    location: '',
    type: null,
    property_for: null,
})
</script>

<template>
    <NavBar/>
    <header class="relative w-full ">
        <img
            src="https://images.unsplash.com/photo-1628133287836-40bd5453bed1?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
            alt="gradient pattern" class="absolute inset-0 w-full h-full object-cover"/>
        <div class="absolute   inset-0 bg-black opacity-80"></div>
        <div class="relative">
            <div class=" mx-auto bg-background/10">


            </div>

            <div class="max-w-screen-2xl py-8 md:py-16 lg:py-24 mx-auto ">

                <div class="">

                    <h1 class="font-sans antialiased font-bold text-3xl md:text-4xl lg:text-5xl text-current [text-wrap:_balance] max-w-3xl mx-auto mb-6 text-center !leading-tight text-white" >
                        Our company mission is to lead the web development.</h1>
                    <div class="mx-auto  min-w-40 max-w-screen-lg  ">
                        <div
                            class="w-full h-full bg-white px-8  grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 p-6  gap-3 rounded-sm">
                            <div class="col-span-2 md:col-span-4">
                                <Input class="p-5 border-2 border-zinc-800/50 focus-visible:border-zinc-800 rounded-sm " :placeholder="t('What are you looking for?')"/>
                            </div>
                            <div>
                                <SyncSelect
                                    :class="cn('p-5 border-2 border-zinc-800/50 focus-visible:border-zinc-800 rounded-sm focus-visible:ring-none focus-visible:outline-none')"
                                    :options="[
                                                    'Rent',
                                                    'Buy',
                                                    'Short stay',
                                             ]"
                                    :placeholder="t('For')"
                                />
                            </div>
                            <div>
                                <SyncSelect
                                    :class="cn('p-5 border-2 border-zinc-800/50 focus-visible:border-zinc-800 rounded-sm focus-visible:ring-none focus-visible:outline-none')"
                                    alignment="end"
                                    :options="[
                                            'Condominium',
                                            'House',
                                            'Apartment',
                                            'Land',
                                            'Commercial',
                                        ]"
                                    :placeholder="t('Property type')"
                                />
                            </div>
                            <div  class="md:col-span-2">
                                <NumberField v-model="form.min_area"  :default-value="0" :max="100" step="0.01"  >
                                    <NumberFieldContent>
                                        <Label class="mb-2">
                                            {{ t('Price Min') }}
                                        </Label>
                                        <NumberFieldInput
                                            :placeholder="t('Min')"
                                            class="p-5 border-2 border-zinc-800/50 focus-visible:border-zinc-800 rounded-sm focus-visible:ring-none focus-visible:outline-none "
                                        />
                                    </NumberFieldContent>

                                </NumberField>
                            </div>
                            <div  class=" md:col-span-2">
                                <NumberField v-model="form.min_area"  :default-value="0" :max="100" step="0.01"  >
                                    <NumberFieldContent>
                                        <Label class="mb-2">
                                            {{ t('Price Max') }}
                                        </Label>
                                        <NumberFieldInput
                                            :placeholder="t('Min')"
                                            class="p-5 border-2 border-zinc-800/50 focus-visible:border-zinc-800 rounded-sm focus-visible:ring-none focus-visible:outline-none "
                                        />
                                    </NumberFieldContent>

                                </NumberField>
                            </div>
                            <div class="col-span-2">
                               <Label class="invisible mb-2">
                                   Loop
                               </Label>
                                <Button class="w-full  px-4 py-5 rounded-sm flex flex-row justify-between border-2">
                                  <div class="flex items-center gap-2">
                                      <Search/>
                                      {{ t("Search") }}
                                  </div>
                                    <small>
                                          890 results
                                     </small>
                                </Button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>
</template>

<style scoped>

</style>
