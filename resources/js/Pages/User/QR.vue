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
                Kode ini dapat kamu gunakan untuk bertransaksi dengan yang lain secara mudah.<br>
                Scan dan masukkan nominal yang ingin ditransfer, selesai!
            </h6>

            <p class="my-3 flex justify-center" v-html="qr" />
            <h3 class="font-bold text-lg flex justify-center" v-html="viewString"></h3>
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
            title: 'Profil',
            breads: [
                {route: route('dashboard'), text: 'Dashboard'},
                {route: route('qr.index'), text: 'QRku'},
            ],
        }
    },
    computed: {
        viewString(){
            return `${this.$page.props.user.name} - ${this.id}`
        }
    }
})
</script>
