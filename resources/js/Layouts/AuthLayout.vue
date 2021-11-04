<template>
    <div class="px-6 py-8 text-white bg-hero w-full rounded-b-3xl min-h-[40vh] shadow-xl">
        <div class="flex items-center justify-center">
            <Link :href="route('welcome')">
                <img :src="asset('storage/images/full-invert.png')" alt="Dopis Invert" class="h-12 mx-2">
            </Link>
        </div>

        <div class="flex items-center justify-center my-12">
            <div class="relative mx-3" v-for="i in 3" :key="i">
                <div class="absolute rounded-full bg-white h-3 w-3" />
            </div>
        </div>

    </div>

    <div class="flex justify-center -mt-24">
        <div class="min-h-[72vh] p-10 mt-6 w-full sm:max-w-lg shadow rounded-t-[2rem] bg-white">
            <slot />
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components:{
        Link
    },
    data(){
        return {
            drivers: [
                {driver: 'google', asset: 'google.webp'},
                {driver: 'github', asset: 'github.svg'}
            ]
        }
    },
})
</script>
