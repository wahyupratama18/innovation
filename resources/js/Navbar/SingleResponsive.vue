<template>
    <Link :href="href" class="pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white hover:text-gray-50 hover:bg-hero/70 hover:border-hero/80 focus:outline-none focus:text-gray-100 focus:bg-hero/90 focus:border-hero transition flex items-center">
        <i v-if="icon" :class="iconize"></i>
        <slot />
    </Link>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        Link
    },
    props: {
        href: String,
        icon: String || null
    },
    setup() {
        
    },
    computed:{
        iconize(){
            return `mdi mdi-${this.icon} mr-4`
        }
    }
})
</script>
