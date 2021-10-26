<template>
    <app-layout :title="title">
        <div class="p-8">
            <Breadcrumb :title="title" :breads="breads" />

            <div class="flex justify-end mb-4">
                <Link :href="route('tellers.create')">
                    <Button>Tambah Pengguna</Button>
                </Link>
            </div>

            <vue-good-table
            :columns="columns"
            :rows="tellers"
            :search-options="search"
            :pagination-options="search"
            :line-numbers="true">
                <template #table-row="props">
                    <div v-if="props.column.field == 'action'">
                        <Link :href="route('tellers.edit', {teller: props.row.id})">
                            <Button>Perbarui</Button>
                        </Link>

                        <DangerButton @click="remove(props.row.id)" v-text="'Hapus'" />
                    </div>
                    <span v-else v-html="props.formattedRow[props.column.field]" />
                </template>

            </vue-good-table>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import { VueGoodTable } from 'vue-good-table-next'
import AppLayout from '@/Layouts/AppLayout.vue'
import Breadcrumb from '@/Navbar/Breadcrumb.vue'
import Button from '@/Jetstream/Button.vue'
import DangerButton from '@/Jetstream/DangerButton.vue'
import { Link } from '@inertiajs/inertia-vue3'

export default defineComponent({
    props:{
        tellers: Array
    },
    data(){
        return {
            breads: [
                {route: route('dashboard'), text: 'Dashboard'},
                {route: route('tellers.index'), text: 'Daftar Teller'},
            ],
            columns: [
                {label: 'Nama', field: 'name'},
                {label: 'Tindakan', field: 'action', sortable: false},
            ],
            title: 'Daftar Teller',
            search: {enabled: true}
        }
    },
    components: {
        AppLayout,
        Breadcrumb,
        Button,
        DangerButton,
        Link,
        VueGoodTable
    },
    setup() {
        
    },
    methods:{
        remove(id){
            Swal.fire({
                title: 'Hapus akun teller ini?',
                showCancelButton: true,
                reverseButtons: true
            }).then(() => {
                this.$inertia.delete(route('tellers.destroy', {teller: id}))
            })
        }
    }
})
</script>
