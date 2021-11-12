<template>
    <user-layout :title="title">
        <template #head>

            <div class="flex items-center">
                <Link :href="route('profile.show')">
                    <i class="mdi mdi-chevron-left mdi-24px mr-3 -mt-3" />
                </Link>
                <Breadcrumb :title="title" :breads="breads" :classes="false" />
            </div>
        </template>


        <update-profile-information-form :user="$page.props.user" v-if="view == 'update-profile'" />

        <update-password-form v-if="view == 'update-password'" />

        <two-factor-authentication-form v-if="view == 'two-factor'" />

        <logout-other-browser-sessions-form :sessions="sessions" v-if="view == 'sessions'" />

        <delete-user-form v-if="view == 'deletion'" />

        <transaction-password-form :alreadyHave="alreadyHave" v-if="view == 'transaction'" />

    </user-layout>

</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import Breadcrumb from '@/Navbar/Breadcrumb.vue'
    import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue'
    import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue'
    import TransactionPasswordForm from '@/Pages/Profile/Partials/TransactionPasswordForm.vue'
    import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue'
    import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue'
    import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue'
    import UserLayout from '@/Layouts/UserLayout.vue'

    export default defineComponent({
        props: [
            'alreadyHave',
            'sessions',
            'title',
            'view'
        ],

        data(){
            return {
                breads: [
                    {route: route('dashboard'), text: 'Dashboard'},
                    {route: route('profile.show'), text: 'Profil anda'},
                    {text: this.title}
                ],
            }
        },

        components: {
            Breadcrumb,
            DeleteUserForm,
            LogoutOtherBrowserSessionsForm,
            TransactionPasswordForm,
            TwoFactorAuthenticationForm,
            UpdatePasswordForm,
            UpdateProfileInformationForm,
            Link,
            UserLayout,
        },
    })
</script>
