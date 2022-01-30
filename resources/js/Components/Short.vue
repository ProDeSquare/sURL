<template>
    <section class="bg-white shadow-sm mt-4 rounded">
        <div class="p-4 md:p-6">
            <div class="mb-4">
                <inertia-link :href="route('update-short', { short: short.hash })" title="Edit Link">
                    <Globe :classes="{ 'w-5 text-gray-500': 1, 'text-purple-600': short.enabled }" />
                </inertia-link>
            </div>

            <h3 class="text-gray-800 truncate">{{ short.title }}</h3>
            <div class="truncate">
                <a
                    class="text-sm text-purple-600 hover:text-purple-800"
                    :href="short.url"
                    target="_blank"
                    rel="noopener noreferrer"
                >{{ short.url }}</a>
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
            short: Object
        },
        components: {
            JetButton,
            Globe
        },
        methods: {
            CopyToClipboard () {
                const el = document.createElement('textarea')
                el.value = `https://surl.prodesquare.com/l/${this.short.hash}`
                document.body.appendChild(el)
                el.select()
                document.execCommand('copy')
                document.body.removeChild(el)
            }
        }
    }
</script>