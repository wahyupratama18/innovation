<template>
    <user-layout :title="title">
        <template #head>
            <div class="flex items-center">
                <Link :href="route('transfer.index')">
                    <i class="mdi mdi-chevron-left mdi-24px mr-3 -mt-3" />
                </Link>
                <Breadcrumb :title="title" :breads="breads" :classes="false" />
            </div>
        </template>

        <!-- <h3 class="font-bold text-lg text-hero" v-text="'Pilih Merchant'" /> -->

        <div class="grid grid-cols-1 md:grid-cols-3">
            <Link :href="route('transfer.create', {account: merchant.id})" class="bg-hero rounded-md shadow p-4 text-white" v-for="(merchant, i) in merchants" :key="i">
                <h5 class="font-bold text-lg" v-text="merchant.name" />
                <span v-text="merchant.id" />
            </Link>
        </div>

    </user-layout>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import Breadcrumb from '@/Navbar/Breadcrumb.vue'
import UserLayout from '@/Layouts/UserLayout.vue'

export default defineComponent({
    components: {
        Link,
        Breadcrumb,
        UserLayout
    },
    props: {
        merchants: Array
    },
    data(){
        return {
            title: 'Pilih Merchant',
            breads: [
                {route: route('dashboard'), text: 'Dashboard'},
                {route: route('transfer.index'), text: 'Metode transaksi'},
                {route: route('transfer.merchants'), text: 'Ke merchant'},
            ]
        }
    },
    methods: {}
})
</script>