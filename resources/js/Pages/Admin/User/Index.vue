<template>
    <app-layout :title="title">
        <div class="p-8">
            <Breadcrumb :title="title" :breads="breads" />

            <div class="flex justify-end mb-4">
                <Link :href="route('users.create')">
                    <Button>Tambah Pengguna</Button>
                </Link>
            </div>

            <vue-good-table
            :columns="columns"
            :rows="users"
            :search-options="search"
            :pagination-options="search"
            :line-numbers="true">
                <template #table-row="props">
                    <span v-if="props.column.field == 'action'">
                        <DangerButton @click="remove(props.row.id)" v-text="'Hapus'" />
                    </span>
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
        users: Array
    },
    data(){
        return {
            breads: [
                {route: route('dashboard'), text: 'Dashboard'},
                {route: route('users.index'), text: 'Daftar Pengguna'},
            ],
            columns: [
                {label: 'Nomor Rekening', field: 'account'},
                {label: 'Nama', field: 'name'},
                {label: 'Tindakan', field: 'action', sortable: false},
            ],
            title: 'Daftar Pengguna',
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
                title: 'Apakah akun ini akan dihapus?',
                showCancelButton: true,
                reverseButtons: true
            }).then(() => {
                this.$inertia.delete(route('users.destroy', {user: id}))
            })
        }
    }
})
</script>
