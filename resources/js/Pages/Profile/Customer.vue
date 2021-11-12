<template>
    <div class="grid grid-cols-1 gap-y-2 divide-y divide-hero text-hero text-lg">
        <Link :href="route('profile.info')" v-if="$page.props.jetstream.canUpdateProfileInformation">
            <i class="mdi mdi-chevron-right mr-2" /> Informasi Profil
        </Link>

        <Link class="pt-2" :href="route('profile.password')" v-if="$page.props.jetstream.canUpdatePassword">
            <i class="mdi mdi-chevron-right mr-2" /> Kata Sandi Akun
        </Link>

        <Link class="pt-2" :href="route('profile.transactpass.index')">
            <i class="mdi mdi-chevron-right mr-2" /> Kata Sandi Transaksi
        </Link>

        <Link class="pt-2" :href="route('profile.two-factor')" v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
            <i class="mdi mdi-chevron-right mr-2" /> Autentikasi Dua Faktor
        </Link>

        <Link class="pt-2" :href="route('profile.sessions')">
            <i class="mdi mdi-chevron-right mr-2" /> Sesi Masuk
        </Link>

        <Link class="pt-2" :href="route('profile.deletion')" v-if="$page.props.jetstream.hasAccountDeletionFeatures">
            <i class="mdi mdi-chevron-right mr-2" /> Hapus Akun
        </Link>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        Link
    }
})
</script>
