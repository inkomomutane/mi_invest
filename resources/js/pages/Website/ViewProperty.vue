<script setup lang="ts">
import NavBar from "@/pages/Website/partials/NavBar.vue";
import Footer from "@/pages/Website/partials/Footer.vue";
import {Button} from "@/components/ui/button";
import {
    Blocks,
    Brain,
    ChevronDown, ChevronRight,
    Cpu,
    Database,
    Globe, Layout,
    LineChart,
    Network,
    Search,
    Server,
    Share2
} from 'lucide-vue-next';
import  {ChevronLeft} from "lucide-vue-next";
import {faker} from "@faker-js/faker";
import {Input} from "@/components/ui/input";
import {
    InputGroup,
    InputGroupAddon,
    InputGroupButton,
    InputGroupInput, InputGroupText,
    InputGroupTextarea
} from "@/components/ui/input-group";
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableFooter,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import {ref} from "vue";
import { CheckIcon, CopyIcon, InfoIcon, FlagIcon } from 'lucide-vue-next'
import {Separator} from "@/components/ui/separator";
import {Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious} from "@/components/ui/carousel";
import Property from "@/components/Property.vue";

const open = ref(false)
const selectedValue = ref('')

const handleSelect = (currentValue: { key: string; value: string }) => {
    const value = currentValue.value
    selectedValue.value = value === selectedValue.value ? '' : value
    open.value = false
}

const invoices = [
    {
        invoice: 'INV001',
        paymentStatus: 'Paid',
        totalAmount: '$250.00',
        paymentMethod: 'Credit Card',
    },
    {
        invoice: 'INV002',
        paymentStatus: 'Pending',
        totalAmount: '$150.00',
        paymentMethod: 'PayPal',
    },
    {
        invoice: 'INV003',
        paymentStatus: 'Unpaid',
        totalAmount: '$350.00',
        paymentMethod: 'Bank Transfer',
    },
    {
        invoice: 'INV004',
        paymentStatus: 'Paid',
        totalAmount: '$450.00',
        paymentMethod: 'Credit Card',
    },
    {
        invoice: 'INV005',
        paymentStatus: 'Paid',
        totalAmount: '$550.00',
        paymentMethod: 'PayPal',
    },
    {
        invoice: 'INV006',
        paymentStatus: 'Pending',
        totalAmount: '$200.00',
        paymentMethod: 'Bank Transfer',
    },
    {
        invoice: 'INV007',
        paymentStatus: 'Unpaid',
        totalAmount: '$300.00',
        paymentMethod: 'Credit Card',
    },
]

</script>

<template>
    <NavBar  :sticky="true" />
     <section class="bg-zinc-100 ">
         <div class=" max-w-screen-2xl mx-auto  p-6 pt-10 md:py-10 sm:px-6 lg:px-24 ">
             <div class="flex flex-row justify-between px-1 md:px-8">
                 <div class="flex flex-row items-center">
                     <div>
                         <Button variant="link">
                             <ChevronLeft/>
                             {{ $t('Back') }}
                         </Button>
                     </div>
                     Wander Santa Rosa Pearl
                 </div>
                 <div>
                     <Button variant="link">
                         <Share2/>
                         {{ $t('Share')}}
                     </Button>
                 </div>
             </div>
             <div>
                 <div class="hidden lg:grid lg:grid-cols-2 lg:row-span-2 gap-2 p-8">
                     <div>
                         <img :src=" faker.image.urlPicsumPhotos()" class="h-[490px] animate-fade-in duration-300 w-full flex-none snap-center snap-always overflow-hidden object-cover rounded bg-zinc-200 ">
                     </div>
                     <div class="grid grid-cols-2 gap-2">
                         <img :src=" faker.image.urlPicsumPhotos()" class="animate-fade-in duration-300 h-[240px] w-full flex-none snap-center snap-always overflow-hidden object-cover rounded bg-zinc-200 ">
                         <img :src=" faker.image.urlPicsumPhotos()"  class="animate-fade-in duration-300 h-[240px] w-full flex-none snap-center snap-always overflow-hidden object-cover rounded bg-zinc-200 " >
                         <img :src=" faker.image.urlPicsumPhotos()" class="animate-fade-in duration-300 h-[240px] w-full flex-none snap-center snap-always overflow-hidden object-cover rounded  bg-zinc-200">
                         <img :src=" faker.image.urlPicsumPhotos()" class="animate-fade-in duration-300 h-[240px] w-full flex-none snap-center snap-always overflow-hidden object-cover rounded  bg-zinc-200">
                     </div>
                 </div>
                 <div class=" gap-8 lg:hidden my-4">
                     <Carousel
                         :opts="{
                            align: 'start',
                            loop: true,
                            }"
                     >
                         <CarouselContent>
                             <CarouselItem v-for="(_, index) in 9" :key="index" class="bg-white">
                                 <img :src=" faker.image.urlPicsumPhotos()" class="animate-fade-in duration-300 h-[240px] w-full flex-none snap-center snap-always overflow-hidden object-cover   bg-zinc-200">
                             </CarouselItem>
                         </CarouselContent>
                         <CarouselPrevious  class="rounded-full bg-default absolute top-1/2 z-50 -translate-y-1/2 opacity-0 group-hover:opacity-100 pointer-events-auto hidden size-7 place-items-center text-primary backdrop-blur-xs grid border border-strong duration-200 transition-transform scale-100 hover:scale-[1.15] hover:border-strong-hover left-2"
                         />
                         <CarouselNext
                             class="rounded-full bg-default absolute top-1/2 z-50 -translate-y-1/2 opacity-0 group-hover:opacity-100 pointer-events-auto hidden size-7 place-items-center text-primary backdrop-blur-xs grid border border-strong duration-200 transition-transform scale-100 hover:scale-[1.15] hover:border-strong-hover right-2"

                         />
                     </Carousel>
                 </div>
             </div>
             <div class="md:flex  px-1 md:px-8 gap-4" >
                  <div class=" md:basis-9/12 flex flex-col space-y-5">
                      <div class="bg-white flex flex-col p-[24px] rounded space-y-3">
                          <h1 class="text-headline-sm text-[#202020]/90 font-medium truncate" data-slot="heading" title="Wander Kingsland Shores">
                              Vende-se APARTAMENTO SUPER MODERNO T3 NA POLANA.
                          </h1>

                          <span class="font-black text-[26px] text-[#202020]/85 ">
                                MZN 8,650,000.00
                          </span>
                           <Separator/>
                           <span class="text-xs font-medium capitalize">
                               Polana, Maputo, POLANA NA Av. Vlademir Lenine/Av. Ho Chi Min
                           </span>
                      </div>
                      <div class="bg-white p-[24px] rounded">
                           <h1 class="text-2xl font-bold ml-2">Propriedades</h1>
                          <div>
                              <Table>
                                  <TableBody>
                                      <TableRow v-for="invoice in invoices" :key="invoice.invoice">
                                          <TableCell class="font-medium">
                                              {{ 'Área:' }}
                                          </TableCell>
                                          <TableCell>{{ invoice.paymentStatus }}</TableCell>
                                      </TableRow>
                                  </TableBody>
                              </Table>
                          </div>
                      </div>
                      <div class="bg-white p-[24px] rounded">
                          <h1 class="text-2xl font-bold ml-2">Descrição</h1>

                          <p class="p-2 py-4 ">
                              DESCUBRA SEU LAR IDEAL: APARTAMENTO T3 MODERNO COM 3 WCS NA AV. VLADEMIR LENINE POR APENAS 8.650.000MT NEGOCIÁVEIS!VIVA COM ESTILO, CONFORTO E EXCLUSIVIDADE NESTE APARTAMENTO T3 NA AVENIDA VLADEMIR LENINE! ESTE IMÓVEL OFERECE UM AMBIENTE MODERNO, ACONCHEGANTE E SEGURO, IDEAL PARA QUEM BUSCA UM LAR COMPLETO E DIFERENCIADO EM UMA LOCALIZAÇÃO PRIVILEGIADA.



                              Detalhes Inesquecíveis:



                              Apartamento Exclusivo por Andar: Desfrute da privacidade e exclusividade de ter apenas um apartamento por andar, proporcionando um ambiente tranquilo e sem barulhos.

                              Localização Privilegiada na Av. Vlademir Lenine: Localizado na Avenida Vlademir Lenine, próximo à Avenida Ho Chi Min, com fácil acesso a restaurantes, lojas, serviços, transporte público e à Beira-Mar.

                              Apartamento situado no 1° andar, ideal para quem busca praticidade e não precisa se preocupar com escadas.

                              Prédio curto com poucos andares, garantindo um ambiente mais familiar e exclusivo.

                              3 WCs para Conforto e Praticidade: Três banheiros completos com pia, chuveiro e vaso sanitário garantem conforto e praticidade para toda a família.

                              Cozinha Ampla e Moderna: Cozinha ampla e moderna, equipada com armários, bancada, fogão, eletrodomésticos e utensílios, ideal para preparar refeições deliciosas.

                              Quartos com Armários Embutidos para Organização: Quartos com armários embutidos para organização e praticidade.

                              2 Varandas para Momentos de Lazer: Duas varandas arejadas, perfeitas para relaxar, tomar sol, apreciar a vista da cidade ou cultivar plantas.

                              Preço Negociável de Apenas 8.650.000MT!

                              Investimento em Qualidade de Vida, Conforto, Exclusividade e Lazer Completo!



                              Este apartamento T3 na Avenida Vlademir Lenine oferece tudo o que você precisa para criar um lar completo, moderno, confortável, seguro e cheio de exclusividade. Desfrute do apartamento por andar, da localização privilegiada, do 1° andar, do prédio curto, dos 3 WCs, da cozinha ampla e moderna, dos quartos com armários embutidos, das 2 varandas e do preço negociável.



                              Agende Sua Visita Hoje Mesmo!
                          </p>
                      </div>
                      <div class="bg-white p-[24px] rounded">
                          <h1 class="text-xl font-bold ml-2">Mapa</h1>
                          <div class="w-full h-[450px] rounded  mt-5">
                              <iframe
                                  class="w-full h-full rounded"
                                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9255.948557260246!2d34.85369049578482!3d-19.831312183546768!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1f2a6a82fd78c331%3A0x44a7c437d8c7cc13!2sMatacuane%2C%20Beira!5e1!3m2!1sen!2smz!4v1766332025855!5m2!1sen!2smz"
                                  style="border:0;" allowfullscreen="" loading="lazy"
                                  referrerpolicy="no-referrer-when-downgrade"></iframe>
                          </div>
                      </div>
                  </div>
                   <div class="hidden md:flex  flex-col md:basis-3/12 bg-white min-h-72 h-fit  sticky top-18  px-4 rounded">
                        <h1 class="text-xl font-semibold text-[#202020]/80  p-3">
                            Contactar
                        </h1>
                        <div class="flex flex-col gap-4 ">

                            <Input type="text" placeholder="Name * " class="py-5 px-4  rounded shadow-none" />
                            <Input type="email" placeholder="Email *" class="py-5  px-4  rounded" />
                            <InputGroup class="py-5  px-4  rounded">
                                <InputGroupAddon class="text-muted-foreground pl-1.5">
                                   +258
                                </InputGroupAddon>
                                <InputGroupInput  />
                            </InputGroup>
                            <InputGroup>
                                <InputGroupTextarea placeholder="Escrever mensagem" class="  px-4  rounded" />
                                <InputGroupAddon align="block-end">
                                    <InputGroupText class="ml-auto">
                                        52% used
                                    </InputGroupText>
                                    <Separator orientation="vertical" class="!h-4" />
                                </InputGroupAddon>
                            </InputGroup>
                            <Button class="w-full rounded mb-6">
                                Enviar mesnagem
                            </Button>
                        </div>
                   </div>
             </div>
              <div class=" w-full  px-1 md:px-8">
                  <div class="basis-12/12  h-full ">
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
                                      Relacionados
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
                              <CarouselItem v-for="(_, index) in 9" :key="index" class="basis-1/2 md:basis-1/3 lg:basis-1/4 xl:basis-1/5">
                                  <Property/>
                              </CarouselItem>
                          </CarouselContent>

                      </Carousel>
                  </div>
              </div>
         </div>
     </section>
     <Footer class="bg-white"/>
</template>
