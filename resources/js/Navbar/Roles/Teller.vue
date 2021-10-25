<template>
    <single-responsive :href="route('deposit.index')">Setor Tunai</single-responsive>
    <single-responsive :href="route('amt.index')">Tarik Tunai</single-responsive>
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
