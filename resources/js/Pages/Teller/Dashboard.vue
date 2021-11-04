<template>
    <app-layout title="Dashboard">
        <div class="p-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Selamat datang, {{ $page.props.user.name }}
            </h2>

            <apexchart class="mt-4" height="300" type="area" :series="series" :options="options" />
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'

    export default defineComponent({
        props: {
            debits: Array,
            credits: Array
        },
        data(){
            return {
                options: {
                    xaxis: {type: 'datetime'},
                    stroke: {curve: 'smooth'},
                    markers: {size: 1}
                },
                series: [
                    { name: 'Debit', data: this.debits },
                    { name: 'Kredit', data: this.credits }
                ]
            }
        },
        components: {
            AppLayout,
            Welcome,
        },
    })
</script>
