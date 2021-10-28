<template>
    <app-layout title="Data Setor Tunai">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <Link :href="route('deposit.index')">
                <i class="mdi mdi-chevron-left" />Kembali
            </Link>

            <h3 class="font-bold">Penyetoran Tunai Berhasil!</h3>

            <div class="bg-white shadow rounded-md p-8 flex items-center justify-between">
                <div>
                    <h4>Nama Pengguna: {{ name }}</h4>
                    <h6>Jumlah: {{ amount }}</h6>
                    <p>Tanggal transaksi: {{ date }}</p>
                </div>

                <div v-html="qr"></div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import AppLayout from '@/Layouts/AppLayout.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Link
        },
        props: {
            amount: String,
            date: String,
            name: String,
            qr: String
        }
    })
</script>
