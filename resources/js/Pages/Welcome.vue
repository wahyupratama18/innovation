<template>
    <Head title="Welcome" />

    <div class="px-6 py-4 text-white bg-hero w-full rounded-b-3xl min-h-[50vh] shadow-xl">
        <Link :href="route('welcome')">
            <img :src="asset('storage/images/full-invert.png')" alt="Dopis Invert" class="h-12 mx-2">
        </Link>

        <div class="mt-12 flex flex-col md:justify-between md:flex-row-reverse items-center">

            <img :src="asset('storage/images/illustrate.png')" alt="Image" class="h-64 md:h-72 my-4">

            <div class="my-4">
                <h2 class="text-3xl">Pembelajaran Literasi Keuangan<br>Pelajar Sekolah</h2>

                <div class="flex mt-6 justify-center md:justify-start">
                    <Link v-if="$page.props.user" :href="route('dashboard')" class="w-full">
                        <InvertButton class="w-full justify-center" v-html="'Beranda'" />
                    </Link>

                    <template v-else>
                        <Link v-if="canLogin" :href="route('login')" class="w-full">
                            <InvertButton class="w-full justify-center" v-html="'Masuk'" />
                        </Link>

                        <Link v-if="canRegister" :href="route('register')" class="text-sm underline">
                            <jet-button v-html="'Registrasi'" />
                        </Link>
                    </template>

                </div>
            </div>

        </div>

        <div class="flex items-center justify-center mb-6">
            <div class="relative mx-3" v-for="i in 3" :key="i">
                <div class="absolute rounded-full bg-white h-3 w-3" />
            </div>
        </div>

    </div>

    <div class="relative min-h-[50vh] bg-gray-100 px-6 py-4 mt-6">

        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white shadow-md p-6" v-for="(faq, i) in faqs" :key="i">
                <h2 class="font-bold text-hero mb-3" v-text="faq.title" />
                <p class="text-gray-800" v-text="faq.description" />
            </div>
        </div>

        <div class="flex justify-center mt-6">
            <div>
                <h3 class="text-hero text-lg text-center">Didukung Oleh</h3>
                <div class="mt-4 flex justify-center">
                    <img :src="asset('storage/images/um.png')" alt="UM" class="h-16 mx-4">
                    <img :src="asset('storage/images/enggal.png')" alt="Enggal Mantun" class="h-16 mx-4">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import JetButton from '@/Jetstream/Button.vue';
    import InvertButton from '@/Jetstream/InvertButton.vue';

    export default defineComponent({
        components: {
            Head,
            Link,
            JetButton,
            InvertButton
        },

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        },

        data(){
            return {
                faqs: [
                    {
                        title: 'Apa itu dopis?',
                        description: "Dopis merupakan is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s."
                    },
                    {
                        title: 'Tujuan Dopis',
                        description: "Dopis memiliki tujuan dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s."
                    },
                    {
                        title: 'Manfaat Dopis',
                        description: "Manfaat Dopis is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s."
                    },
                ]
            }
        }
    })
</script>
