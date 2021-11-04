<template>
    <Head title="Forgot Password" />

    <auth-layout>

        <div class="mb-4 text-sm text-gray-600">
            Lupa kata sandi anda? Tidak masalah. 
            Masukkan email anda dan kami akan mengirimkan email berisi link reset 
            yang dapat memperbarui kata sandi anda.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus />
            </div>

            <jet-button class="w-full mt-4 justify-center"  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Email Password Reset Link
            </jet-button>
        </form>

    </auth-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head } from '@inertiajs/inertia-vue3';
    import AuthLayout from '@/Layouts/AuthLayout.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'

    export default defineComponent({
        components: {
            Head,
            AuthLayout,
            JetButton,
            JetInput,
            JetLabel,
            JetValidationErrors
        },

        props: {
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: ''
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.email'))
            }
        }
    })
</script>
