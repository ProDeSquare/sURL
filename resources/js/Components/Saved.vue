<template>
    <section class="bg-white shadow-sm rounded">
        <div class="p-4 md:p-6">
            <div class="mb-4">
                <button @click="deleteLink" title="Delete Link">
                    <Trash class="w-4 text-red-600" />
                </button>
            </div>

            <h3 class="text-gray-800 truncate">{{ save.title }}</h3>
            <div class="truncate">
                <a
                    class="text-sm text-purple-600 hover:text-purple-800"
                    :href="save.url"
                    target="_blank"
                    rel="noopener noreferrer"
                >{{ save.url }}</a>
            </div>
            <div class="text-center mt-3">
                <jet-button class="" @click.native="CopyToClipboard">
                    <Clipboard class="w-4 mr-2" />
                    <span>Copy to clipboard</span>
                </jet-button>
            </div>
        </div>
    </section>
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import Trash from '@/Components/Icons/Trash'
    import Clipboard from '@/Components/Icons/Clipboard'

    export default {
        props: {
            save: Object
        },

        components: {
            Trash,
            JetButton,
            Clipboard,
        },

        methods: {
            CopyToClipboard () {
                const el = document.createElement('textarea')
                el.value = this.save.url
                document.body.appendChild(el)
                el.select()
                document.execCommand('copy')
                document.body.removeChild(el)
            },

            deleteLink () {
                this.$inertia.delete(route('delete-save', {save: this.save.id}), {
                    onSuccess: () => {
                        // window.location.href = route('saved-links-index')
                    }
                })
            }
        }
    }
</script>