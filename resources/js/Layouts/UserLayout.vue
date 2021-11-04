<template>
    <div>
        <Head :title="title" />

        <div class="px-6 py-8 text-white bg-hero w-full min-h-[30vh] shadow-xl">
            <div class="mb-6 flex justify-between" v-if="dashboard">
                <Link :href="route('dashboard')">
                    <img :src="asset('storage/images/full-invert.png')" alt="Universitas Negeri Malang" class="h-8">
                </Link>

                <Link :href="route('profile.show')">
                    <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                        <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                    </button>

                    <span v-else class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                            {{ $page.props.user.name }}

                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </Link>
            </div>

            <slot name="head" />
        </div>

        <div class="min-h-[50vh] p-10 -mt-6 w-full rounded-t-[2rem] bg-white">
            <slot />
        </div>
        
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components:{
        Head,
        Link
    },
    props: {
        title: String,
        dashboard: {
            type: Boolean,
            default: false
        }
    }
})
</script>
