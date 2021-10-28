<template>
    <app-layout title="Arus Keluar Masuk Teller">
        <div class="p-8">
            <div class="bg-white shadow-md rounded-md p-4">
                <div class="mb-3">
                    <p class="mb-1">Pilih Rentang Waktu</p>
                    <div class="flex items-center w-full">
                        <datepicker v-model="from" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                        <span class="mx-4">s.d.</span>
                        <datepicker v-model="to" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                    </div>
                </div>

                <div class="flex justify-end">
                    <jet-button type="button" class="mt-4" @click="range">
                        Cari Data
                    </jet-button>
                </div>

            </div>

            <div class="mt-4" v-show="series[0].data">
                <h4>Grafik Pergerakan Uang di Teller</h4>
                <apexchart height="300" type="area" :series="series" :options="options" />
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Datepicker from 'vue3-datepicker'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'

export default defineComponent({
    components:{
        AppLayout,
        Datepicker,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
    },
    data(){
        return {
            from: null,
            to: null,
            options: {
                xaxis: {type: 'datetime'},
                stroke: {curve: 'smooth'},
                markers: {size: 1}
            },
            series: [
                { name: 'Kredit', data: [] },
                { name: 'Debit', data: [] }
            ]
        }
    },
    methods: {
        range(){
            if (this.from && this.to) {
                axios.get(route('report.range', {
                    from: this.from,
                    to: this.to
                })).then(response => {
                    this.series = [
                        { name: 'Kredit (K)', data: response.data.credits },
                        { name: 'Debit (D)', data: response.data.debits }
                    ]
                }).catch(response => {
                    console.log(response)
                });
            }
        }
    }
})
</script>
