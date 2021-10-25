<template>
    <div v-if="!content">
        <Link class="cursor-pointer" :href="href">
            <slot></slot>
        </Link>
    </div>
    <div v-else>
        <jet-dropdown align="right" width="48">
            <template #trigger>
                <button>
                    <slot></slot>
                </button>
            </template>

            <template #content>
                <slot name="content"></slot>
            </template>
        </jet-dropdown>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        Link
    },
    props: {
        content: String,
        href: String
    },
    setup() {
        
    },
})
</script>
