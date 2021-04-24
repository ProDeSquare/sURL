<template>
    <section class="bg-white shadow-sm mt-4 rounded">
        <div class="p-4 md:p-6">
            <div class="mb-4">
                <Globe :classes="{ 'w-5 text-gray-500': 1, 'text-purple-600': link.enabled }" />
            </div>

            <h3 class="text-gray-800 truncate">{{ link.title }}</h3>
            <div class="truncate">
                <a class="text-sm text-purple-600 hover:text-purple-800" :href="link.url">{{ link.url }}</a>
            </div>
            <div class="mt-3 text-center">
                <jet-button class="" @click.native="CopyToClipboard">Copy link to clipboard</jet-button>
            </div>
        </div>
    </section>
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import Globe from '@/Components/Icons/Globe'

    export default {
        props: {
            link: Object
        },
        components: {
            JetButton,
            Globe
        },
        methods: {
            CopyToClipboard () {
                const el = document.createElement('textarea')
                el.value = `http://127.0.0.1:8000/${this.link.hash}`
                document.body.appendChild(el)
                el.select()
                document.execCommand('copy')
                document.body.removeChild(el)
            }
        }
    }
</script>