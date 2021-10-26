<template>
    <app-layout title="Perbarui Data Teller">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <jet-form-section @submitted="store">
                <template #title>
                    Perbarui Data Teller
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
                        <jet-label for="current_password" value="Kata Sandi Lama" />
                        <jet-input id="current_password" type="password" class="mt-1 block w-full" v-model="form.current_password" ref="current_password" autocomplete="old-password" />
                        <jet-input-error :message="form.errors.current_password" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="password" value="Kata Sandi Baru" />
                        <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" ref="password" autocomplete="new-password" />
                        <jet-input-error :message="form.errors.password" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="password_confirmation" value="Konfirmasi Kata Sandi" />
                        <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" ref="password_confirmation" autocomplete="new-password" />
                        <jet-input-error :message="form.errors.password_confirmation" class="mt-2" />
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
        props: {
            teller: Array
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.teller.name,
                    email: this.teller.email,
                    current_password: '',
                    password: '',
                    password_confirmation: '',
                }),
            }
        },
        methods: {
            store(){
                this.form.put(route('tellers.update', {teller: this.teller.id}), {
                    preserveScroll: true,
                })
            }
        }
    })
</script>