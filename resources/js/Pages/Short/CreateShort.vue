<template>
    <app-layout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-6 lg:my-8">
            <jet-form-section @submitted="createLink">
                <template #title>
                    Shorten a link
                </template>

                <template #description>
                    Filling out this form would allow you to create short urls for the links provided
                </template>

                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="title" value="Give your link a title" />
                        <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title" />
                        <jet-input-error :message="form.errors.title" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="url" value="Link to shorten" />
                        <jet-input id="url" type="text" class="mt-1 block w-full" v-model="form.url" />
                        <jet-input-error :message="form.errors.url" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="hash" value="Optional Hash" />
                        <jet-input id="hash" type="text" class="mt-1 block w-full" v-model="form.hash" />
                        <jet-input-error :message="form.errors.hash" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="url" value="Save to collection" />

                        <select
                            name="collection"
                            class="mt-1 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md w-full"
                            v-model="form.collection"
                        >
                            <option value="">Select Collection</option>

                            <option
                                v-for="collection in collections"
                                :key="collection.id"
                                :value="collection.id"
                            >
                                {{ collection.name }}
                            </option>
                        </select>
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
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'

    export default {
        components: {
            AppLayout,
            JetFormSection,
            JetButton,
            JetInput,
            JetInputError,
            JetLabel,
            JetActionMessage
        },
        props: {
            collections: Object,
        },
        data () {
            return {
                form: this.$inertia.form({
                    title: '',
                    url: '',
                    hash: '',
                    collection: '',
                })
            }
        },
        methods: {
            createLink () {
                this.form.post(route('store-short'), {
                    errorBag: 'createLink',
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