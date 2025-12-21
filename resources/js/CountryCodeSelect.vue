<script setup lang="ts">
import {InputGroupAddon, InputGroupButton} from "@/components/ui/input-group";
import {Command, CommandEmpty, CommandGroup, CommandInput, CommandItem, CommandList} from "@/components/ui/command";
import {FlagIcon} from "lucide-vue-next";
import {Popover, PopoverContent, PopoverTrigger} from "@/components/ui/popover";
import phones  from "@/components/phone_country_codes.json"
const items =  phones
</script>

<template>
    <Popover>
        <PopoverTrigger as-child>
            <InputGroupAddon>
                <InputGroupButton variant="secondary" size="icon-xs">
                    <FlagIcon
                        :size="16"
                        :stroke-width="2"
                        class="shrink-0 text-muted-foreground/80"
                        aria-hidden="true"
                    />
                </InputGroupButton>
            </InputGroupAddon>
        </PopoverTrigger>
        <PopoverContent class="w-full min-w-[var(--reka-popper-anchor-width)] p-0" align="start">
            <Command>
                <CommandInput placeholder="Search services..." />
                <CommandList>
                    <CommandEmpty>No service found.</CommandEmpty>
                    <CommandGroup>
                        <CommandItem
                            v-for="item in items"
                            :key="item.code"
                            :data-value="item.dial_code"
                            @select="handleSelect"
                            class="flex items-center justify-between"
                        >
                            <div class="flex items-center gap-2">

                                {{ item.name }}
                            </div>
                            <span class="text-xs text-muted-foreground">
                                                                {{ item.dial_code }}
                                                        </span>
                        </CommandItem>
                    </CommandGroup>
                </CommandList>
            </Command>
        </PopoverContent>
    </Popover>
</template>
