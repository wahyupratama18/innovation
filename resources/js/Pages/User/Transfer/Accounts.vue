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

        <div>
            <jet-label for="account" :value="'Masukkan rekening yang akan ditransfer'" />
            <jet-input id="account" type="number" class="mt-1 block w-full" v-model="account" ref="account" placeholder="Masukkan nomor rekening" @keyup="validate" />
            <jet-input-error :message="errors" class="mt-2" />
        </div>

        <jet-button type="button" class="mt-4 justify-center w-full" @click="pay" :disabled="!open">
            Lanjutkan
        </jet-button>
    </user-layout>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import Breadcrumb from '@/Navbar/Breadcrumb.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import UserLayout from '@/Layouts/UserLayout.vue'

export default defineComponent({
    components: {
        Link,
        Breadcrumb,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        UserLayout
    },
    data(){
        return {
            title: 'Kirim Uang',
            breads: [
                {route: route('dashboard'), text: 'Dashboard'},
                {route: route('transfer.index'), text: 'Metode transaksi'},
                {route: route('transfer.accounts'), text: 'Ke rekening'},
            ],
            account: null,
            errors: null,
            open: false
        }
    },
    methods: {
        validate(){
            this.open = false

            if (this.account.length == 10){
                axios.get(route('userFinder', {account: this.account}))
                .then(() => {
                    this.errors = null
                    this.open = true
                }).catch(() => {
                    this.errors = 'Akun tidak ditemukan'
                })
                return;
            }
            this.errors = 'Panjang digit tidak valid'
        },
        pay(){
            if(this.open){
                return this.$inertia.visit(route('transfer.create', {account: this.account}))
            }
            this.errors = 'Nomor rekening belum dimasukkan dengan benar'
        }
    }
})
</script>