<script setup lang="ts">
  import NavBar from "@/pages/Website/partials/NavBar.vue";
  import {Form} from "vee-validate";
  import Footer from "@/pages/Website/partials/Footer.vue";
  import  {faker } from "@faker-js/faker";
  import {NUMBER} from "@/lib/helpers";
  import Property from "@/components/Property.vue";
  import {ChevronRight} from "lucide-vue-next";
  import {Button} from "@/components/ui/button";
  import { t} from "@/lib/utils"
  import {
      Select,
      SelectContent,
      SelectGroup,
      SelectItem,
      SelectLabel,
      SelectTrigger,
      SelectValue,
  } from "@/components/ui/select";

  import {Input} from "@/components/ui/input";
  import {
      NumberField,
      NumberFieldContent,
      NumberFieldDecrement,
      NumberFieldIncrement,
      NumberFieldInput,
  } from "@/components/ui/number-field";
  import {InputGroup, InputGroupAddon, InputGroupInput} from "@/components/ui/input-group";
  defineProps<{}>()
</script>

<template>
    <NavBar  />
    <div class="bg-white sticky top-0  z-10">
        <div class="max-w-screen-xl mx-auto px-8 pt-4 ">
             <div class="flex flex-wrap gap-4">
                 <Select>
                     <SelectTrigger class="w-[180px] mt-0">
                         <SelectValue :placeholder="t('Property type')" />
                     </SelectTrigger>
                     <SelectContent>
                         <SelectGroup>
                             <SelectLabel>Fruits</SelectLabel>
                             <SelectItem value="apple">
                                 Apple
                             </SelectItem>
                             <SelectItem value="banana">
                                 Banana
                             </SelectItem>
                             <SelectItem value="blueberry">
                                 Blueberry
                             </SelectItem>
                             <SelectItem value="grapes">
                                 Grapes
                             </SelectItem>
                             <SelectItem value="pineapple">
                                 Pineapple
                             </SelectItem>
                         </SelectGroup>
                     </SelectContent>
                 </Select>
                 <Select>
                     <SelectTrigger class="w-[180px] mt-0">
                         <SelectValue :placeholder="t('Localization')" />
                     </SelectTrigger>
                     <SelectContent>
                         <SelectGroup>
                             <SelectLabel>Fruits</SelectLabel>
                             <SelectItem value="apple">
                                 Apple
                             </SelectItem>
                             <SelectItem value="banana">
                                 Banana
                             </SelectItem>
                             <SelectItem value="blueberry">
                                 Blueberry
                             </SelectItem>
                             <SelectItem value="grapes">
                                 Grapes
                             </SelectItem>
                             <SelectItem value="pineapple">
                                 Pineapple
                             </SelectItem>
                         </SelectGroup>
                     </SelectContent>
                 </Select>
                 <Select>
                     <SelectTrigger class="w-[180px] mt-0">
                         <SelectValue :placeholder="t('Condition')" />
                     </SelectTrigger>
                     <SelectContent>
                         <SelectGroup>
                             <SelectLabel>Fruits</SelectLabel>
                             <SelectItem value="apple">
                                 Apple
                             </SelectItem>
                             <SelectItem value="banana">
                                 Banana
                             </SelectItem>
                             <SelectItem value="blueberry">
                                 Blueberry
                             </SelectItem>
                             <SelectItem value="grapes">
                                 Grapes
                             </SelectItem>
                             <SelectItem value="pineapple">
                                 Pineapple
                             </SelectItem>
                         </SelectGroup>
                     </SelectContent>
                 </Select>
                 <NumberField id="age" :default-value="18" :min="0">
                     <NumberFieldContent>
                         <NumberFieldInput  :placeholder="t('To')" />
                     </NumberFieldContent>
                 </NumberField>
                  <div class="w-full flex flex-row gap-3">
                      <Input :placeholder="t('Search')" />
                      <Button>
                          {{ t('Search') }}
                      </Button>
                  </div>
             </div>
            <div class="flex items-center mb-5 justify-between">
                <div  class="flex flex-row">
                    <h2 class="tracking-tight dark:text-gray-50 font-bold  uppercase border-l-2   border-l-black dark:border-white/50 pl-2  ">
                        Results
                    </h2>
                    <ChevronRight class="opacity-50"/>
                </div>

                <div class="flex flex-row items-center py-3">
                          <span class="me-2">
                              {{ t('Order by') }}
                          </span>
                    <Select>
                        <SelectTrigger class="w-[180px] mt-0">
                            <SelectValue placeholder="Select a fruit" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectLabel>Fruits</SelectLabel>
                                <SelectItem value="apple">
                                    Apple
                                </SelectItem>
                                <SelectItem value="banana">
                                    Banana
                                </SelectItem>
                                <SelectItem value="blueberry">
                                    Blueberry
                                </SelectItem>
                                <SelectItem value="grapes">
                                    Grapes
                                </SelectItem>
                                <SelectItem value="pineapple">
                                    Pineapple
                                </SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                </div>
            </div>
        </div>
    </div>
    <section class="">
         <div class="max-w-screen-xl mx-auto  p-6 pt-10 md:py-10 sm:px-6 ">

             <div class="flex flex-wrap  space-y-12 ">
                 <Property v-for="i in [1,2,3,4,5,4,54,4,6,6,6,6,6]" class="basis-1/2 md:basis-1/3 lg:basis-1/4 xl:basis-1/5"/>
             </div>
         </div>
    </section>

    <Footer/>
</template>
