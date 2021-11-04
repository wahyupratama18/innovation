<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-hero border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-hero/70 active:bg-hero/90 focus:outline-none focus:border-hero/90 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
        <slot></slot>
    </button>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    })
</script>
