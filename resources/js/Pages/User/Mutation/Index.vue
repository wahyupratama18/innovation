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

        <form @submit.prevent="store">

            <!-- Errors -->
            <div class="mb-4" v-if="form.errors">
                <jet-input-error :message="form.errors.type" class="mt-2" />
                <jet-input-error :message="form.errors.period" class="mt-2" />
                <jet-input-error :message="form.errors.from" class="mt-2" />
                <jet-input-error :message="form.errors.to" class="mt-2" />
            </div>

            <h3 v-text="'Pilih Periode'" />
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div class="px-2" v-for="(period, i) in periods" :key="i">
                    <invert-button
                        type="button"
                        :class="{'bg-hero text-white': active == i}"
                        :style="[active == i ? 'color: #fff!important' : '']"
                        class="mt-4 justify-center w-full"
                        @click="setData(i)"
                        v-html="period" />
                </div>
            </div>
            <jet-section-border />

            <h3 v-text="'(atau) Pilih Tanggal Khusus'" />

            <div class="flex flex-col md:flex-row items-center">
                <jet-input
                    id="from"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.from"
                    placeholder="Dari tanggal"
                    :disabled="form.type == 'period'"
                    @change="setData('from')" />

                <span class="text-center p-2" v-html="'s.d.'" />

                <jet-input
                    id="to"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.to"
                    placeholder="Sampai tanggal"
                    :disabled="form.type == 'period'"
                    @change="setData('to')" />
            </div>

            <jet-button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="active == null" class="mt-4 justify-center w-full">
                Ambil data
            </jet-button>
        </form>

        <!-- Lists -->
    </user-layout>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import Breadcrumb from '@/Navbar/Breadcrumb.vue'
import InvertButton from '@/Jetstream/InvertButton.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetSectionBorder from '@/Jetstream/SectionBorder.vue'
import JetLabel from '@/Jetstream/Label.vue'
import UserLayout from '@/Layouts/UserLayout.vue'

export default defineComponent({
    props: {
        periods: Object
    },
    components: {
        Breadcrumb,
        Link,
        InvertButton,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        JetSectionBorder,
        UserLayout
    },
    data(){
        return {
            title: 'Riwayat Transaksi',
            breads: [
                {route: route('dashboard'), text: 'Dashboard'},
                {route: route('mutations.index'), text: 'Riwayat'},
            ],
            form: this.$inertia.form({
                type: null,
                period: null,
                from: null,
                to: null
            }),
            active: null,
            closed: true,
            mutations: []
        }
    },
    methods: {
        setData(value) {
            this.closed = false

            if (Object.keys(this.periods).includes(value)) {
                if (this.active == value) {
                    this.form.type = null
                    this.form.period = null
                    this.active = null
                    this.closed = true
                    return
                }

                this.form.type = 'period'
                this.form.period = value
                this.active = value

                this.form.from = null
                this.form.to = null
                return;
            } else if (['from', 'to'].includes(value)) {
                this.form.type = 'date'
                this.active = 'date'
                return;
            }
            this.active = null
            this.closed = true

        },
        store(){
            this.form.post(route('mutations.store'), {
                preserveScroll: true,
                onSuccess: (data) => {
                    console.log(data)
                }
            })
        },
    }
})
</script>