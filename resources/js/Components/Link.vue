<template>
    <section class="bg-white shadow-sm mt-4 rounded">
        <div></div>
        <div class="p-4 md:p-6">
            <h3 class="text-gray-800">{{ link.title }}</h3>
            <a class="text-sm text-purple-600 hover:text-purple-800" :href="link.url">{{ link.url }}</a>
            <div class="mt-3">
                <jet-button>Copy to clipboard</jet-button>
            </div>
        </div>
    </section>
</template>

<script>
    import JetButton from '@/Jetstream/Button'

    export default {
        props: {
            link: Object
        },
        components: {
            JetButton
        }
    }
</script>