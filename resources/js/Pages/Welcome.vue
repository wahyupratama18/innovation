<template>
    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="fixed top-0 px-6 py-4 text-white bg-hero w-full flex items-center">

            <div class="flex">
                <img :src="asset('storage/images/um.png')" alt="Universitas Negeri Malang" class="h-12 mx-2">
                <img :src="asset('storage/images/smea.png')" alt="SMKN 1 Banyuwangi" class="h-12 mx-2">
            </div>

            <div class="flex items-center ml-auto mr-3">
                <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm underline">
                    Dashboard
                </Link>

                <template v-else>
                    <Link :href="route('login')" class="text-sm underline">
                        Log in
                    </Link>

                    <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm underline">
                        Register
                    </Link>
                </template>

            </div>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            testing
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            Link,
        },

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    })
</script>
