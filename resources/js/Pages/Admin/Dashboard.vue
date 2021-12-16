<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white">

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-hero rounded-md shadow p-4 text-white" v-for="(user, i) in users" :key="i">
                        <h5 class="font-bold text-lg" v-text="user.role" />
                        <span v-text="user.count" />
                    </div>
                </div>

                <h4 class="font-bold text-hero my-4" v-text="'Grafik Pergerakan Uang'" />
                <apexchart height="300" type="area" :series="series" :options="options" />

            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Welcome,
        },
        props: {
            debits: Array,
            credits: Array,
            users: Array
        },
        data(){
            return {    
                options: {
                    xaxis: {type: 'datetime'},
                    stroke: {curve: 'smooth'},
                    markers: {size: 1}
                },
                series: [{
                    name: 'Debit',
                    data: this.debits
                },{
                    name: 'Kredit',
                    data: this.credits
                }],
            }
        }
    })
</script>
