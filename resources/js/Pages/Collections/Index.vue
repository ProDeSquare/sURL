<template>
    <app-layout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-6 lg:my-8">
            <jet-form-section @submitted="createCollection">
                <template #title>
                    Create a collection
                </template>

                <template #description>
                    Collections help you to organize your links.
                </template>

                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="name" value="Give your collection a name" />
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>
                </template>

                <template #actions>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Created.
                    </jet-action-message>

                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create
                    </jet-button>
                </template>
            </jet-form-section>

            <template v-if="collections.length">
                <jet-section-border></jet-section-border>

                <jet-action-section>
                    <template #title>
                        Your collections
                    </template>

                    <template #description>
                        You've created total of {{ collections.length }} collections.
                    </template>

                    <template #content>
                        <p class="text-gray-800 mb-3">
                            Deleting any collection would delete all the saves and shorts stored in them.
                        </p>

                        <ul>
                            <li
                                v-for="collection in collections"
                                :key="collection.id"
                                class="mt-2 text-gray-800"
                            >
                                <Collection :collection="collection" />
                            </li>
                        </ul>
                    </template>
                </jet-action-section>
            </template>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Collection from '@/Components/Collection'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import JetActionSection from '@/Jetstream/ActionSection'

    export default {
        components: {
            AppLayout,
            Collection,
            JetFormSection,
            JetButton,
            JetInput,
            JetInputError,
            JetLabel,
            JetActionMessage,
            JetSectionBorder,
            JetActionSection,
        },
        props: {
            collections: Object,
        },
        data () {
            return {
                form: this.$inertia.form({
                    name: '',
                })
            }
        },
        methods: {
            createCollection () {
                this.form.post(route('collection-save'), {
                    errorBag: 'createCollection',
                    preserveScroll: true,
                    onSuccess: () => this.form.reset(),
                    onError: () => {
                        // 
                    }
                })
            }
        }
}
</script>