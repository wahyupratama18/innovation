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
            <jet-label for="amount" :value="`Masukkan nominal yang akan dikirimkan kepada ${user} (${account})`" />
            <jet-input id="amount" type="number" class="mt-1 block w-full" v-model="form.amount" ref="amount" placeholder="Masukkan Nominal yang akan dikirimkan" @keyup="notEmpty" />
            <jet-input-error :message="form.errors.amount" class="mt-2" />
            <jet-input-error :message="form.errors.password" class="mt-2" />
        </div>

        <transaction-password @confirmed="store">
            <jet-button type="button" :class="{ 'opacity-25': form.processing }" :disabled="form.processing || closed" class="mt-4 justify-center w-full">
                Lanjutkan
            </jet-button>
        </transaction-password>
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
import TransactionPassword from '@/Jetstream/TransactionPassword.vue'
import UserLayout from '@/Layouts/UserLayout.vue'

export default defineComponent({
    components: {
        Link,
        Breadcrumb,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        TransactionPassword,
        UserLayout
    },
    props: {
        account: Number,
        user: String
    },
    data(){
        return {
            title: 'Kirim Uang',
            breads: [
                {route: route('dashboard'), text: 'Dashboard'},
                {route: route('transfer.index'), text: 'Metode transaksi'},
                {route: route('transfer.create', {account: this.account}), text: 'Kirim uang'},
            ],
            form: this.$inertia.form({
                account_id: this.account,
                amount: '',
                password: ''
            }),
            closed: true
        }
    },
    methods: {
        notEmpty(){
            this.closed = !(parseInt(this.form.amount) > 0)
        },
        store(password){
            this.form.password = password
            this.form.post(route('transfer.store'), {
                preserveScroll: true,
                onSuccess: () => this.form.reset()
            })
        },
    }
})
</script>