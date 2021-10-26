<template>
    <div>
        <single-responsive :href="route('users.index')">Data Pengguna</single-responsive>
        <single-responsive :href="route('tellers.index')">Data Teller</single-responsive>
        <single-responsive :href="route('report.index')">Cash Flow di Teller</single-responsive>
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
