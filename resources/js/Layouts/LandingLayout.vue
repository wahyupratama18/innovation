<template>
    <div>
        <Head :title="title" />

        <basic>
            <template #big>
                <links :href="route('welcome')">Home</links>
                <links :href="route('services')">Layanan</links>
                <links :href="route('blog')">Blog</links>
                <links :href="route('portfolio')">Portfolio</links>
                <links :href="route('contacts')">Hubungi Kami</links>

                <links v-if="$page.props.user" :href="route('dashboard')">Dashboard</links>
                <template v-else>
                    <links :href="route('login')">Log In</links>
                    <links :href="route('register')">Daftar</links>
                </template>
            </template>

            <template #responsive>
                <single-responsive :href="route('welcome')">Home</single-responsive>
                <multiple-responsive :href="route('blog')" icon="list" :subs="sub">
                    Testing
                </multiple-responsive>
                <multiple-responsive :href="route('blog')" icon="list" :subs="sub">
                    Testing 2
                </multiple-responsive>
            </template>
        </basic>

        <!-- Page Content -->
        <main class="mt-20">
            <slot />
        </main>

        <footer class="bg-gray-800 text-white p-12">
            <div class="grid md:grid-cols-3">
                
                <div class="my-3">
                    <img src="files/images/white.png" alt="Footer Icon" class="h-12">
                    <h2 class="font-bold mt-6">Rampung Tugase Tenang Atine</h2>
                    <p class="mt-4">
                        Banyuwangi, Jawa Timur, Indonesia<br><br>
                        Terhubung dengan kami dengan mudah di
                    </p>
                    <div class="flex gap-x-2 mt-2">
                        <a href="" class="rounded-full bg-hero-second hover:bg-hero-first p-2 h-8 w-8 flex items-center justify-center">
                            <i class="mdi mdi-web"></i>
                        </a>
                        <a href="https://instagram.com/enggal_mantun" class="rounded-full bg-hero-second hover:bg-hero-first p-2 h-8 w-8 flex items-center justify-center">
                            <i class="mdi mdi-instagram"></i>
                        </a>
                        <!-- <a href="https://instagram.com/enggal_mantun" class="rounded-full bg-hero-second hover:bg-hero-first p-2 h-8 w-8 flex items-center justify-center">
                            <i class="mdi mdi-google-maps"></i>
                        </a> -->
                    </div>
                </div>

                <div class="my-3">
                    <h2 class="font-bold">Pranala</h2>
                    <div class="grid divide-y divide-hero-first text-sm mt-4">
                        <Link :href="route('about')" class="py-2">
                            Tentang Kami
                        </Link>
                        <Link :href="route('portfolio')" class="py-2">
                            Portofolio
                        </Link>
                        <Link :href="route('blog')" class="py-2">
                            Blog
                        </Link>
                        <Link :href="route('events')" class="py-2">
                            Agenda
                        </Link>
                        <Link :href="route('contacts')" class="py-2">
                            Hubungi Kami
                        </Link>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import Basic from '@/Navbar/Basic.vue';
import Links from '@/Navbar/Links.vue';
import SingleResponsive from '@/Navbar/SingleResponsive.vue';
import MultipleResponsive from '@/Navbar/MultipleResponsive.vue';

export default defineComponent({
    props: {
        title: String,
    },
    components: {
        Link,
        Basic,
        Links,
        SingleResponsive,
        MultipleResponsive,
    },
    computed: {
        sub(){
            return [
                { href: route('blog'), icon: 'chevron-up', title: 'Testing'}
            ]
        }
    }
})
</script>
