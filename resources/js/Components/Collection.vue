<template>
    <div class="flex">
        <button class="focus:outline-none" @click="deleteCollection" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            <Trash class="w-3 text-red-600 hover:text-red-500" />
        </button>

        <p class="ml-4">{{ collection.name }}</p>
    </div>
</template>

<script>
    import Trash from '@/Components/Icons/Trash'

    export default {
        props: {
            collection: Object
        },
        data() {
            return {
                form: this.$inertia.form(),
            }
        },
        components: {
            Trash,
        },
        methods: {
            deleteCollection () {
                this.$inertia.delete(route('collection-delete', {collection: this.collection.id}), {
                    onSuccess: () => {
                        window.location.href = route('create-collection-page')
                    }
                })
            }
        }
    }
</script>