<template>
    <app-layout title="Dashboard">
        <div class="p-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Selamat datang, {{ $page.props.user.name }}
            </h2>

            <apexchart height="300" type="area" :series="series" :options="options" />
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'

    export default defineComponent({
        props: {
            graph: Array,
            date: Array
        },
        data(){
            return {
                options: {
                    labels: this.date,
                    xaxis: {type: 'datetime'},
                    stroke: {curve: 'smooth'},
                    markers: {size: 1}
                },
                series: [{
                    name: 'Grafik keuangan',
                    data: this.graph
                }]
            }
        },
        components: {
            AppLayout,
            Welcome,
        },
    })
</script>
