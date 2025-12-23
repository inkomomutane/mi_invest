<script setup lang="ts">

  import {cn} from "@/lib/utils";

 const props =  defineProps({
      class: {
          type: String,
          default: ''
      },
     content: {
         type: String,
         default: ''
     },
      noOpacity: {
          type: Boolean,
          default: false
      }
  })


</script>

<template>
    <section :class="cn('relative',props.class)">
        <!-- Carousel background -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
             <div>
                 <slot name="coverImage"/>
             </div>
        </div>
        <!-- Overlay -->
        <div
            :class="cn('absolute top-0 left-0 w-full h-full',   {
                'bg-slate-600 opacity-80' :noOpacity,
             'bg-slate-800  opacity-60' :!noOpacity})
        "
        ></div>
        <!-- Hero content -->
        <div class="absolute container mx-auto px-4">
            <section class="bg-transparent">
                {{ content ?? '' }}
            </section>
        </div>
        <slot/>
    </section>
</template>
