<template>
    <app-layout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-6 lg:my-8">
            <jet-form-section @submitted="updateLink">
                <template #title>
                    Update link
                </template>

                <template #description>
                    Edit "{{ link.title }}" link. Remember that you would not be able to change the hash previously created.
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
                        <jet-label for="hash" value="Hash" />
                        <jet-input id="hash" type="text" class="mt-1 block w-full bg-gray-100 text-gray-500" :value="link.hash" disabled />
                        <jet-input-error :message="form.errors.hash" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <label class="flex items-center">
                            <jet-checkbox name="enabled" v-model:checked="form.enabled" />
                            <span class="ml-2 text-sm text-gray-600">Enabled</span>
                        </label>
                    </div>
                </template>

                <template #actions>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Updated.
                    </jet-action-message>

                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update
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
    import JetCheckbox from '@/Jetstream/Checkbox'

    export default {
        components: {
            AppLayout,
            JetFormSection,
            JetButton,
            JetInput,
            JetInputError,
            JetLabel,
            JetActionMessage,
            JetCheckbox
        },
        props: {
            link: Object
        },
        data () {
            return {
                form: this.$inertia.form({
                    title: this.link.title,
                    url: this.link.url,
                    enabled: Boolean(this.link.enabled)
                })
            }
        },
        methods: {
            updateLink () {
                this.form.put(route('update-link', { link: this.link.hash }), {
                    errorBag: 'createLink',
                    preserveScroll: true,
                    onSuccess: () => {
                        //
                    },
                    onError: () => {
                        // 
                    }
                })
            }
        }
}
</script>