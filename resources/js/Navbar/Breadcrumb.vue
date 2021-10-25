<template>
    <div class="m-4 pt-4">
        <h1 class="font-bold" v-html="title"></h1>
        <ol class="flex">
            <li v-for="(bread, key) in breads" :key="key" class="flex items-center">
                <Link :href="bread.route" v-html="bread.text" v-if="bread.route"></Link>
                <a href="javascript:void(0)" v-html="bread.text" v-else></a>

                <i class="mdi mdi-chevron-right mx-2" v-if="key < breads.length - 1"></i>
            </li>
        </ol>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components:{
        Link
    },
    props: {
        title: String,
        breads: Array
    },
})
</script>
