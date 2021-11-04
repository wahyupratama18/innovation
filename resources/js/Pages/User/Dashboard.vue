<template>
    <user-layout title="Dashboard" :dashboard="true">
        <template #head>
            <h2 class="font-bold text-xl"
                v-text="`Hai, ${$page.props.user.name}`" />
            <h4 class="font-semibold mb-6"
                v-text="`Saldo anda ${balance}`"/>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 my-6">
                <div class="flex items-center justify-center text-center" v-for="(menu, i) in menus" :key="i">
                    <Link :href="menu.route">
                        <i :class="menu.icon + ' mdi-36px'" />
                        <h6 v-text="menu.title" />
                    </Link>
                </div>
            </div>

        </template>

        <div>
            <!-- Scanner -->
            <div class="flex justify-center -mt-20">
                <Link
                    :href="route('transfer.scan')"
                    class="border-4 border-hero rounded-full w-24 h-24 bg-white flex items-center justify-center flex-col text-hero">
                    <i class="mdi mdi-qrcode-scan mdi-36px" />
                    <span class="font-bold" v-text="`Bayar`" />
                </Link>
            </div>

            <div class="p-6">
                <h4 class="font-bold text-hero mb-4" v-text="'Grafik Keuangan Anda'" />
                <apexchart height="300" type="area" :series="series" :options="options" />
            </div>

        </div>
    </user-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import UserLayout from '@/Layouts/UserLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'

    export default defineComponent({
        props: {
            balance: String,
            graph: Array
        },
        data(){
            return {
                options: {
                    xaxis: {type: 'datetime'},
                    stroke: {curve: 'smooth'},
                    markers: {size: 1}
                },
                series: [{
                    name: 'Grafik keuangan',
                    data: this.graph
                }],
                menus: [{
                    icon: 'mdi mdi-qrcode',
                    route: route('qr.index'),
                    title: 'QR ku'
                }, {
                    icon: 'mdi mdi-bank-transfer',
                    route: route('transfer.index'),
                    title: 'Transfer'
                }, {
                    icon: 'mdi mdi-cash-fast',
                    route: route('withdraw.create'),
                    title: 'Tarik Tunai'
                }, {
                    icon: 'mdi mdi-history',
                    route: route('mutations.index'),
                    title: 'Riwayat Keuangan'
                }]
            }
        },
        components: {
            UserLayout,
            Welcome,
            Link
        },
    })
</script>
