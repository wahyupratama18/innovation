<template>
    <span>
        <slot />

        <jet-dialog-modal :show="confirmingPassword" @close="closeModal">
            <template #title v-html="title" />

            <template #content>
                {{ content }}

                <div class="mt-4">
                    <jet-input type="password" class="mt-1 block w-3/4" placeholder="Password"
                                ref="password"
                                v-model="password"
                                @keyup.enter="confirmPassword" />
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    Batalkan
                </jet-secondary-button>

                <jet-button class="ml-2" @click="confirmPassword" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" v-html="button" />
            </template>
        </jet-dialog-modal>
    </span>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetButton from './Button.vue'
    import JetDialogModal from './DialogModal.vue'
    import JetInput from './Input.vue'
    import JetSecondaryButton from './SecondaryButton.vue'

    export default defineComponent({
        emits: ['confirmed'],

        props: {
            title: {
                default: 'Password Transaksi',
            },
            content: {
                default: 'Demi keamanan bertransaksi, mohon untuk memasukkan password transaksi.',
            },
            button: {
                default: 'Konfirmasi',
            }
        },

        components: {
            JetButton,
            JetDialogModal,
            JetInput,
            JetSecondaryButton,
        },

        data() {
            return {
                password: '',
            }
        },

        methods: {
            startConfirmingPassword() {
                axios.get(route('password.confirmation')).then(response => {
                    if (response.data.confirmed) {
                        this.$emit('confirmed');
                    } else {
                        this.confirmingPassword = true;

                        setTimeout(() => this.$refs.password.focus(), 250)
                    }
                })
            },

            confirmPassword() {
                this.form.processing = true;

                axios.post(route('password.confirm'), {
                    password: this.form.password,
                }).then(() => {
                    this.form.processing = false;
                    this.closeModal()
                    this.$nextTick(() => this.$emit('confirmed'));
                }).catch(error => {
                    this.form.processing = false;
                    this.form.error = error.response.data.errors.password[0];
                    this.$refs.password.focus()
                });
            },

            closeModal() {
                this.confirmingPassword = false
                this.form.password = '';
                this.form.error = '';
            },
        }
    })
</script>
