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

        <qrcode-stream :camera="camera" @decode="onDecode" @init="onInit" />
        <transaction-password @confirmed="store" :content="content">
            <button type="button" class="hidden" ref="invoke" />
        </transaction-password>
    </user-layout>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import { QrcodeStream } from 'vue3-qrcode-reader'
import Breadcrumb from '@/Navbar/Breadcrumb.vue'
import TransactionPassword from '@/Jetstream/TransactionPassword.vue'
import UserLayout from '@/Layouts/UserLayout.vue'

export default defineComponent({
    components: {
        Link,
        Breadcrumb,
        QrcodeStream,
        TransactionPassword,
        UserLayout
    },
    data(){
        return {
            title: 'Menu Transaksi',
            breads: [
                {route: route('dashboard'), text: 'Dashboard'},
                {route: route('transfer.index'), text: 'Metode transaksi'},
                {route: route('transfer.scan'), text: 'Scan QR'},
            ],
            camera: 'auto',
            content: ''
        }
    },
    methods:{
        onInit(promise){
            promise.catch(console.error)
        },
        turnOff(){
            this.camera = 'off'
        },
        turnOn(){
            this.camera = 'auto'
        },
        async onDecode(data){
            this.turnOff()
            const type = data.substr(10,2)
            const account = data.substr(16,10)

            if (type == '11'){
                return this.$inertia.visit(route('transfer.create', {account: account}))
            }

            const userLen = parseInt(data.substr(28,2))
            const user = parseInt(data.substr(30, userLen))
            
            const validator = 32 + userLen
            const amountLen = parseInt(data.substr(validator,2))
            const amount = parseInt(data.substr(validator + 2, amountLen))

            this.content = `Masukkan kata sandi transaksi untuk melanjutkan transfer ke ${user} sejumlah ${this.replacing(amount)}`
            this.$refs.invoke.click()
        },

        replacing(amount){
            return "Rp" + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }

    }
})
</script>
