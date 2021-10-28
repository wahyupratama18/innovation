<template>
    <app-layout title="Tarik Tunai">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <jet-form-section @submitted="store">
                <template #title>
                    Tarik Tunai (ON Spot)
                </template>

                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="account_id" value="Nomor Rekening" />
                        <jet-input id="account_id" type="number" class="mt-1 block w-full" v-model="form.account_id" ref="account_id" @change="check" />
                        <jet-input-error :message="form.errors.account_id" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="name" value="Nama Pemilik Rekening" />
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" ref="name" readonly />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="amount" value="Jumlah Tarik (Rp)" />
                        <jet-input id="amount" type="number" class="mt-1 block w-full" v-model="form.amount" ref="amount" />
                        <jet-input-error :message="form.errors.amount" class="mt-2" />
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

            <jet-form-section @submitted="update">
                <template #title>
                    Tarik Tunai (Via APP)
                </template>

                <template #form>
                    <!-- <div class="col-span-6 sm:col-span-4">
                        <jet-label for="account_id" value="Nomor Rekening" />
                        <jet-input id="account_id" type="number" class="mt-1 block w-full" v-model="form.account_id" ref="account_id" @change="check" />
                        <jet-input-error :message="form.errors.account_id" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="name" value="Nama Pemilik Rekening" />
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" ref="name" readonly />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="amount" value="Jumlah Tarik (Rp)" />
                        <jet-input id="amount" type="number" class="mt-1 block w-full" v-model="form.amount" ref="amount" readonly />
                        <jet-input-error :message="form.errors.amount" class="mt-2" />
                    </div> -->

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

    export default defineComponent({
        components: {
            AppLayout,
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
        },
        data() {
            return {
                form: this.$inertia.form({
                    account_id: '',
                    amount: '',
                    name: '',
                }),
            }
        },
        methods: {
            check(){
                axios.get(route('findAccount', {account: this.form.account_id}))
                .then(response => {
                    this.form.name = response.data.name
                }).catch(response => {
                    this.form.name = ''
                })
            },
            store(){
                this.form.post(route('amt.store'), {
                    preserveScroll: true,
                    onSuccess: () => this.form.reset()
                })
            }
        }
    })
</script>
