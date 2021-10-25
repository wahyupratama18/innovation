<template>
    <div class="grid sm:grid-cols-2 min-h-screen">
        <div class="hidden sm:flex items-center bg-hero-second">
            <img :src="asset('files/images/white.png')" alt="Enggal Mantun White Logo" class="h-20 ml-4">
        </div>
        <div class="flex items-center min-h-screen">
            <div class="p-8 w-full">
                <img :src="asset('files/images/full.png')" alt="Enggal Mantun  Logo" class="block sm:hidden my-4 h-20">

                <slot />

                <h4 class="w-full text-center border-b border-gray-400 leading-[.1em] my-4">
                    <span class="bg-white px-2.5">atau</span>
                </h4>
                <h5 class="text-center">Masuk dengan akun sosial</h5>
                <div class="flex items-center justify-center gap-x-6">
                    <div v-for="(drive, key) in drivers" :key="key" class="flex items-center">
                        <a :href="route('social.redirection', {driver: drive.driver})"  class="rounded-full bg-white shadow-lg p-3">
                            <img :src="asset(`files/images/${drive.asset}`)" alt="Auths" class="h-8">
                        </a>
                    </div>
                </div>
            </div>
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
