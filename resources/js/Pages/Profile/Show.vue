<template>
    <user-layout :title="title" v-if="$page.props.user.is_customer">
        <template #head>

            <div class="flex items-center">
                <Link :href="route('dashboard')">
                    <i class="mdi mdi-chevron-left mdi-24px mr-3 -mt-3" />
                </Link>
                <Breadcrumb :title="title" :breads="breads" :classes="false" />
            </div>

            <div class="flex flex-col md:flex-row md:justify-between">
                <div class="flex items-center my-4">
                    <img class="h-8 w-8 rounded-full object-cover mr-3" v-if="$page.props.jetstream.managesProfilePhotos" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                    <p>
                        <span class="text-lg font-bold" v-text="$page.props.user.name" /><br>
                        <span v-text="`Akun ${ $page.props.user.role_name }`" />
                    </p>
                </div>

                <form @submit.prevent="logout" class="w-full md:w-min my-4">
                    <jet-invert-button type="submit" class="justify-center w-full">
                        Keluar
                    </jet-invert-button>
                </form>
            </div>
        </template>

        <customer/>

    </user-layout>

    <app-layout :title="title" v-else>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <employee :sessions="sessions" />
        </div>

    </app-layout>

</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Breadcrumb from '@/Navbar/Breadcrumb.vue'
    import Customer from '@/Pages/Profile/Customer.vue'
    import Employee from '@/Pages/Profile/Employee.vue'
    import JetInvertButton from '@/Jetstream/InvertButton.vue'
    import UserLayout from '@/Layouts/UserLayout.vue'

    export default defineComponent({
        props: ['sessions'],

        data(){
            return {
                title: 'Profil',
                breads: [
                    {route: route('dashboard'), text: 'Dashboard'},
                    {route: route('profile.show'), text: 'Profil anda'},
                ],
            }
        },

        components: {
            AppLayout,
            Breadcrumb,
            Customer,
            Employee,
            JetInvertButton,
            Link,
            UserLayout
        },
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            }
        }
    })
</script>
