<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight tracking-wide">
                Saved Links
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Paginator :paginator="saves" />

                <div class="grid justify-items-end mt-4 mb-2">
                    <div>
                        <jet-dropdown align="right" width="60">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        Collection

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <jet-dropdown-link :href="route('saved-links-index')">
                                    All
                                </jet-dropdown-link>

                                <jet-dropdown-link
                                    v-for="collection in collections"
                                    :key="collection.id"
                                    :href="route('saved-links-index', { collection: collection.id, name: collection.name })"
                                >
                                    {{ collection.name }}
                                </jet-dropdown-link>
                            </template>
                        </jet-dropdown>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-2">
                    <div class="w-full md:w-4/12 lg:w-3/12 px-2" v-for="save in saves.data" :key="save.id">
                        <Saved :save="save" />
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Paginator from '@/Components/Paginator'
    import Saved from '@/Components/Saved'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'

    export default {
        props: {
            saves: Object,
            collections: Object,
        },

        components: {
            AppLayout,
            Paginator,
            Saved,
            JetDropdown,
            JetDropdownLink,
        }
    }
</script>