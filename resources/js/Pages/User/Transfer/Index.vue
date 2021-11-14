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

        <div class="grid grid-cols-1 gap-y-2 divide-y divide-hero text-hero text-lg">
            <Link :href="route('transfer.scan')">
                <i class="mdi mdi-chevron-right mr-2" /> Scan QR
            </Link>

            <Link class="pt-2" :href="route('transfer.accounts')">
                <i class="mdi mdi-chevron-right mr-2" /> Transfer Ke Akun
            </Link>

            <Link class="pt-2" :href="route('transfer.merchant')">
                <i class="mdi mdi-chevron-right mr-2" /> Ke Organisasi / Merchant
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
    data(){
        return {
            title: 'Menu Transaksi',
            breads: [
                {route: route('dashboard'), text: 'Dashboard'},
                {route: route('transfer.index'), text: 'Pilih metode transaksi'},
            ],
        }
    }
})
</script>
