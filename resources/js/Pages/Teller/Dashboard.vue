<template>
    <app-layout title="Dashboard">
        <div class="p-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Selamat datang, {{ $page.props.user.name }}
            </h2>

            <div class="grid grid-cols-1 divide-y-2 divide-none">
                <div>
                    <h6>Penerimaan uang (K)</h6>
                    <apexchart height="300" type="area" :series="cred.series" :options="cred.options" />
                </div>
                <div>
                    <h6>Penyaluran uang (D)</h6>
                    <apexchart height="300" type="area" :series="deb.series" :options="deb.options" />
                </div>
            </div>
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
                deb: {
                    options: {
                        labels: this.debits.date,
                        xaxis: {type: 'datetime'},
                        stroke: {curve: 'smooth'},
                        markers: {size: 1}
                    },
                    series: [{
                        name: 'Grafik penyaluran',
                        data: this.debits.flow
                    }]
                },
                cred: {
                    options: {
                        labels: this.credits.date,
                        xaxis: {type: 'datetime'},
                        stroke: {curve: 'smooth'},
                        markers: {size: 1}
                    },
                    series: [{
                        name: 'Grafik penerimaan',
                        data: this.credits.flow
                    }]
                },
            }
        },
        components: {
            AppLayout,
            Welcome,
        },
    })
</script>
