<template>
    <div>
        <single-responsive :href="route('users.index')" icon="account-group">
            Pengguna
        </single-responsive>
        <single-responsive :href="route('merchants.index')" icon="store">
            Merchant / Organisasi
        </single-responsive>
        <single-responsive :href="route('tellers.index')" icon="badge-account-outline">
            Teller
        </single-responsive>
        <single-responsive :href="route('report.index')" icon="chart-areaspline">
            Cash Flow di Teller
        </single-responsive>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import SingleResponsive from '@/Navbar/SingleResponsive.vue';

export default defineComponent({
    components:{
        SingleResponsive
    },
    setup() {
        
    },
})
</script>
