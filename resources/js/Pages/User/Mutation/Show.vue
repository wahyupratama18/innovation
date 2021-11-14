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

        <h1 class="text-hero font-bold text-lg" v-text="'Transaksi Berhasil!'" />

        <div class="flex flex-col md:flex-row md:justify-between items-center">
            <table class="my-2 w-full">
                <tbody v-for="(table, i) in tables" :key="i">
                    <tr>
                        <td class="font-bold mr-2" v-html="table.name" />
                        <td v-html="`: ${table.value}`" />
                    </tr>
                </tbody>
            </table>
            <span class="my-2" v-html="mutation.qr" />
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
        mutation: Object
    },
    data(){
        return {
            title: 'Lihat Mutasi',
            breads: [
                {route: route('dashboard'), text: 'Dashboard'},
                {route: route('mutations.index'), text: 'Daftar mutasi'},
                {route: route('mutations.show', {mutation: this.mutation.reference}), text: 'Lihat data'},
            ],
            tables: [
                {name: 'Nomor Referensi', value: this.mutation.reference},
                {name: 'Nama Transaksi', value: this.mutation.name},
                {name: 'Jumlah', value: this.mutation.amount},
                {name: 'Tipe Transaksi', value: this.mutation.type_read},
            ]
        }
    }
})
</script>