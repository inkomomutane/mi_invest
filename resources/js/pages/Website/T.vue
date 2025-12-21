<script setup lang="ts">
import { ChevronDown } from 'lucide-vue-next'
import { ref } from 'vue'
// import { cn } from '@/lib/utils'
import { Popover, PopoverContent, PopoverTrigger } from '../ui/Popover'
import Button from '../ui/Button.vue'
import {
    Command,
    CommandEmpty,
    CommandGroup,
    CommandInput,
    CommandItem,
    CommandList
} from '../ui/Command'
import Label from '../ui/Label.vue'
import {
    Blocks,
    Brain,
    Cpu,
    Database,
    Globe,
    Layout,
    LineChart,
    Network,
    Search,
    Server
} from 'lucide-vue-next'

const items = [
    {
        value: 'analytics platform',
        label: 'Analytics Platform',
        icon: LineChart,
        number: 2451
    },
    {
        value: 'ai services',
        label: 'AI Services',
        icon: Brain,
        number: 1832
    },
    {
        value: 'database systems',
        label: 'Database Systems',
        icon: Database,
        number: 1654
    },
    {
        value: 'compute resources',
        label: 'Compute Resources',
        icon: Cpu,
        number: 943
    },
    {
        value: 'network services',
        label: 'Network Services',
        icon: Network,
        number: 832
    },
    {
        value: 'web services',
        label: 'Web Services',
        icon: Globe,
        number: 654
    },
    {
        value: 'monitoring tools',
        label: 'Monitoring Tools',
        icon: Search,
        number: 432
    },
    {
        value: 'server management',
        label: 'Server Management',
        icon: Server,
        number: 321
    },
    {
        value: 'infrastructure',
        label: 'Infrastructure',
        icon: Blocks,
        number: 234
    },
    {
        value: 'frontend services',
        label: 'Frontend Services',
        icon: Layout,
        number: 123
    }
]

const open = ref(false)
const selectedValue = ref('')

const handleSelect = (currentValue: { key: string; value: string }) => {
    const value = currentValue.value
    selectedValue.value = value === selectedValue.value ? '' : value
    open.value = false
}
</script>

<template>
    <div class="space-y-2">

    </div>
</template>
