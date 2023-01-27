<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight tracking-wide truncate">
                {{ short.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-gray-700">
                    <div class="truncate">
                        <span class="font-semibold">URL: </span>
                        <a class="text-purple-600 hover:text-purple-800" :href="short.url">{{ short.url }}</a>
                    </div>
                    <div class="truncate">
                        <span class="font-semibold">sURL: </span>
                        <a class="text-purple-600 hover:text-purple-800" :href="route('short-redirect', short)">{{ route('short-redirect', short) }}</a>
                    </div>
                    <div class="text-gray-600">
                        <span class="font-semibold text-gray-700">Created: </span>
                        {{ short.created_at }} -
                        <span class="font-semibold text-gray-700">Last Updated: </span>
                        {{ short.updated_at }}
                    </div>
                </div>

                <jet-section-border></jet-section-border>

                <div>
                    {{ clicks }}
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetSectionBorder from '@/Jetstream/SectionBorder'

    export default {
        props: {
            short: Object,
            collection: Object,
            clicks: Object,
        },
        components: {
            AppLayout,
            JetSectionBorder,
        }
    }
</script>