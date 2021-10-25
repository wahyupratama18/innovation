<template>
    <button
        :class="toggler"
        class="pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white hover:text-gray-50 hover:bg-hero/70 hover:border-hero/80 focus:outline-none focus:text-gray-100 focus:bg-hero/90 focus:border-hero transition flex items-center w-full"
        @click="toggle"
        >
        <i v-if="icon" :class="iconize"></i>
        <span><slot /></span>

        <span class="ml-auto">
            <svg class="w-4 h-4 transition-transform transform" :class="rotate" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </span>
    </button>

    <div v-show="open" class="mt-2 space-y-2 px-4 mb-4">
        <template v-for="(sub, index) in subs" :key="index">
            <Link :href="sub.href" class="block px-4 text-sm text-white transition-colors duration-200 rounded-md hover:text-hero-first/90">
                <i :class="`mdi mdi-${sub.icon} mr-4 align-middle`"></i>
                <span v-html="sub.title"></span>
            </Link>
        </template>
    </div>
</template>

<script>
import { defineComponent, onMounted, onUnmounted } from "vue";
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    emits: ['close', 'toggle'],
    components: {
        Link
    },
    props: {
        href: String,
        icon: String || null,
        subs: Object,
        open: {
            default: false
        }
    },
    setup(props, {emit}) {
        const toggle = () => {
            props.open = !props.open;
        }
        const close = () => {
            props.open = false;
        }

        // onMounted(() => document.addEventListener('keydown', closeOnEscape))
        onUnmounted(() => {
            close()
        })

        return {
            close,
            toggle
        }
    },
    
    computed:{
        iconize(){
            return `mdi mdi-${this.icon} mr-4`
        },
        toggler(){
            return this.open ? 'bg-hero-first' : ''
        },
        rotate(){
            return this.open ? 'rotate-180' : ''
        }
    }
})
</script>
