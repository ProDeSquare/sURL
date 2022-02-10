<template>
    <app-layout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-6 lg:my-8">
            <jet-form-section @submitted="updateLink">
                <template #title>
                    Update link
                </template>

                <template #description>
                    Edit "{{ short.title }}" link. Remember that you would not be able to change the hash previously created.
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
                        <jet-input id="hash" type="text" class="mt-1 block w-full bg-gray-100 text-gray-500" :value="short.hash" disabled />
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

            <jet-section-border></jet-section-border>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-6 lg:my-8">
            <jet-action-section>
                <template #title>
                    Delete link
                </template>

                <template #description>
                    Delete current link permanently
                </template>

                <template #content>
                    <div class="max-w-xl text-sm text-gray-600">
                        Are you sure you want to delete this link permanently? Once this link is deleted it would no longer point to your desired location.
                    </div>

                    <div class="mt-5">
                        <jet-danger-button @click="deleteLink" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Delete Link
                        </jet-danger-button>
                    </div>
                </template>
            </jet-action-section>
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
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import JetCheckbox from '@/Jetstream/Checkbox'
    import JetActionSection from '@/Jetstream/ActionSection'
    import JetDangerButton from '@/Jetstream/DangerButton'

    export default {
        components: {
            AppLayout,
            JetFormSection,
            JetButton,
            JetInput,
            JetInputError,
            JetLabel,
            JetActionMessage,
            JetCheckbox,
            JetSectionBorder,
            JetActionSection,
            JetDangerButton
        },
        props: {
            short: Object
        },
        data () {
            return {
                form: this.$inertia.form({
                    title: this.short.title,
                    url: this.short.url,
                    enabled: Boolean(this.short.enabled)
                })
            }
        },
        methods: {
            updateLink () {
                this.form.put(route('update-short', { short: this.short.hash }), {
                    errorBag: 'createLink',
                    preserveScroll: true,
                    onSuccess: () => {
                        //
                    },
                    onError: () => {
                        // 
                    }
                })
            },
            deleteLink () {
                this.$inertia.delete(route('delete-short', {short: this.short.hash}), {
                    onSuccess: () => {
                        // 
                    }
                })
            }
        }
}
</script>