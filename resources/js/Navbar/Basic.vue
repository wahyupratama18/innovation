<template>
    <header class="w-full fixed top-0 z-20 mx-auto flex h-20 shadow-md bg-white">
        <div class="flex items-center py-2 px-4 pr-3 bg-hero rounded-br-[3rem]">

            <Link :href="route('welcome')" class="flex items-center">
                <img :src="asset('storage/images/um.png')" alt="Universitas Negeri Malang" class="h-8 mx-2">
                <img :src="asset('storage/images/smea.png')" alt="SMKN 1 Banyuwangi" class="h-8 mx-2">
            </Link>

            <button v-if="extras" @click="toggle" class="hidden md:inline-flex items-center justify-center p-2 rounded-md text-white focus:outline-none transition">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="pathView" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="reversePath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="flex items-center justify-end pr-8 flex-grow text-hero">
            <!-- {{-- Big Screen --}} -->
            <div class="hidden md:flex md:items-center gap-x-4 lg:gap-x-8">
                <slot name="big" />
            </div>

            <!-- {{-- Hamburger --}} -->
            <div class="flex md:hidden">
                <slot name="small" />
                <button @click="toggle" class="inline-flex items-center justify-center p-2 rounded-md hover:text-hero hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-hero transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="pathView" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="reversePath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

    </header>

    <transition leave-active-class="duration-200">
        <div v-show="show" class="fixed inset-0 overflow-y-auto z-10" scroll-region>
            <transition enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0">
                <div v-show="show" class="fixed inset-0 transform transition-all z-10" @click="close">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
            </transition>

            <transition enter-active-class="ease-in-out duration-1000"
                    enter-from-class="transform -translate-x-full"
                    enter-to-class="transform transform-x-0"
                    leave-active-class="ease-in-out duration-1000"
                    leave-from-class="transform transform-x-0"
                    leave-to-class="transform -translate-x-full">
                <div v-show="show" class="fixed top-0 bottom-0 bg-hero text-white w-64 transform transition-all z-10 mt-20 pt-4">
                    <slot name="responsive" />
                </div>
            </transition>
        </div>
    </transition>

</template>

<script>
import { defineComponent, onMounted, onUnmounted } from "vue";
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    emits: ['close', 'toggle'],
    components:{
        Link
    },
    props: {
        show: {
            default: false
        },
        extras: {
            default: false
        }
    },
    watch: {
        show: {
            immediate: true,
            handler: (show) => {
                if (show) {
                    document.body.style.overflow = 'hidden'
                } else {
                    document.body.style.overflow = null
                }
            }
        }
    },

    setup(props, {emit}) {
        const toggle = () => {
            props.show = !props.show;
        }
        const close = () => {
            props.show = false;
        }

        const closeOnEscape = (e) => {
            if (e.key === 'Escape' && props.show) {
                close()
            }
        }

        onMounted(() => document.addEventListener('keydown', closeOnEscape))
        onUnmounted(() => {
            document.removeEventListener('keydown', closeOnEscape)
            document.body.style.overflow = null
        })

        return {
            close,
            toggle
        }
    },

    computed:{
        pathView(){
            return this.show ? 'hidden' : 'inline-flex'
        },
        reversePath(){
            return this.show ? 'inline-flex' : 'hidden'
        }
    }
})
</script>