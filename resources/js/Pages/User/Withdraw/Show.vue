<template>
    <user-layout :title="title">
        <template #head>

            <div class="flex items-center">
                <Link :href="route('dashboard')">
                    <i class="mdi mdi-chevron-left mdi-24px mr-3 -mt-3" />
                </Link>
                <Breadcrumb :title="title" :breads="breads" :classes="false" />
            </div>

        </template>

        <div class="text-hero">
            <h6>
                Demi keamanan, qr ini hanya valid hingga satu jam setelah permintaan tarik tunai berlangsung.<br>
                Segera hubungi teller untuk melakukan penarikan tunai!
            </h6>

            <p class="my-3 flex justify-center" v-html="qr" />
            <h3 class="font-bold text-lg flex justify-center" v-html="qr"></h3>
        </div>
    </user-layout>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';
import Breadcrumb from '@/Navbar/Breadcrumb.vue'
import UserLayout from '@/Layouts/UserLayout.vue'

export default defineComponent({
    props: {
        id: Number,
        qr: String
    },
    components: {
        Breadcrumb,
        Link,
        UserLayout
    },
    data(){
        return {
            title: 'Ambil uang',
            breads: [
                {route: route('dashboard'), text: 'Dashboard'},
                {route: route('withdraw.store'), text: 'Ambil uang'},
            ],
        }
    }
})
</script>
