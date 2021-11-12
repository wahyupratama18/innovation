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

        <form class="text-hero flex flex-col" @submit.prevent="store">
            <div>
                <jet-label for="amount" value="Jumlah (Rp)" />
                <jet-input id="amount" type="number" class="mt-1 block w-full" v-model="form.amount" ref="amount" />
                <jet-input-error :message="form.errors.amount" class="mt-2" />
                <jet-input-error :message="form.errors.password" class="mt-2" />
            </div>

            <jet-button type="button" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="mt-4 justify-center">
                Lanjutkan
            </jet-button>
        </form>
    </user-layout>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';
import Breadcrumb from '@/Navbar/Breadcrumb.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import UserLayout from '@/Layouts/UserLayout.vue'

export default defineComponent({
    props: {},
    components: {
        Breadcrumb,
        Link,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        UserLayout
    },
    data(){
        return {
            title: 'Tarik Tunai',
            breads: [
                {route: route('dashboard'), text: 'Dashboard'},
                {route: route('withdraw.create'), text: 'Penarikan Tunai'},
            ],
            form: this.$inertia.form({
                amount: '',
                password: ''
            }),
        }
    },
    methods: {
        store(){
            this.form.post(route('withdraw.store'), {
                preserveScroll: true,
                onSuccess: () => this.form.reset()
            })
        }
    }
})
</script>