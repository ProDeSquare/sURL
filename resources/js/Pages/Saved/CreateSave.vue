<template>
    <app-layout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-6 lg:my-8">
            <jet-form-section @submitted="saveLink">
                <template #title>
                    Save a link
                </template>

                <template #description>
                    Filling out this form would allow you to save urls
                </template>

                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="title" value="Give your link a title" />
                        <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title" />
                        <jet-input-error :message="form.errors.title" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="url" value="Link to save" />
                        <jet-input id="url" type="text" class="mt-1 block w-full" v-model="form.url" />
                        <jet-input-error :message="form.errors.url" class="mt-2" />
                    </div>
                </template>

                <template #actions>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </jet-action-message>

                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
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
        data () {
            return {
                form: this.$inertia.form({
                    title: '',
                    url: '',
                })
            }
        },
        methods: {
            saveLink () {
                this.form.post(route('store-save'), {
                    errorBag: 'saveLink',
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