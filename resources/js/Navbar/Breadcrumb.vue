<template>
    <div :class="activate">
        <h1 class="font-bold" v-html="title" />
        <ol class="flex">
            <li v-for="(bread, key) in breads" :key="key" class="flex items-center">
                <Link :href="bread.route" v-html="bread.text" v-if="bread.route" />
                <a href="javascript:void(0)" v-html="bread.text" v-else />

                <i class="mdi mdi-chevron-right mx-2" v-if="key < breads.length - 1" />
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
        breads: Array,
        classes: {
            type: Boolean,
            default: true
        }
    },
    computed:{
        activate(){
            return this.classes ? 'm-4 pt-4' : 'mb-4'
        }
    }
})
</script>
