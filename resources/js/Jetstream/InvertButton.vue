<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-white border border-hero/90 rounded-md font-semibold text-xs text-hero uppercase tracking-widest hover:bg-hero/60 hover:text-white hover:border-white active:bg-hero/60 active:text-white focus:outline-none focus:bg-hero focus:text-white focus:border-white focus:ring focus:ring-white disabled:opacity-25 transition">
        <slot />
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
