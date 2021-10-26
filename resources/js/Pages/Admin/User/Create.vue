<template>
    <app-layout title="Tambah Pengguna">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <jet-form-section @submitted="store">
                <template #title>
                    Tambah Pengguna
                </template>

                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="name" value="Nama" />
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" ref="name" />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="email" value="Email" />
                        <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" ref="email" />
                        <jet-input-error :message="form.errors.email" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="password" value="Kata Sandi" />
                        <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" ref="password" autocomplete="new-password" />
                        <jet-input-error :message="form.errors.password" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="password_confirmation" value="Konfirmasi Kata Sandi" />
                        <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" ref="password_confirmation" autocomplete="new-password" />
                        <jet-input-error :message="form.errors.password_confirmation" class="mt-2" />
                    </div>
                    
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="angkatan" value="Angkatan" />
                        <v-select :options="angkatans" label="text" value="id" v-model="form.angkatan" :reduce="angkatan => angkatan.id" class="mt-1 block w-full" />
                        <jet-input-error :message="form.errors.angkatan" class="mt-2" />
                    </div>
                    
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="department" value="Jurusan" />
                        <v-select :options="departments" label="name" value="id" v-model="form.department" :reduce="department => department.id" class="mt-1 block w-full" />
                        <jet-input-error :message="form.errors.department" class="mt-2" />
                    </div>
                </template>

                <template #actions>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Tersimpan.
                    </jet-action-message>

                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Simpan
                    </jet-button>
                </template>
            </jet-form-section>

        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import vSelect from 'vue-select'

    export default defineComponent({
        components: {
            AppLayout,
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            vSelect
        },
        props:{
            angkatans: Array,
            departments: Array,
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    angkatan: '',
                    department: '',
                }),
            }
        },
        methods: {
            store(){
                this.form.post(route('users.store'), {
                    preserveScroll: true,
                })
            }
        }
    })
</script>
