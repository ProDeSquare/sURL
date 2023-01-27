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
                        <a
                            class="text-purple-600 hover:text-purple-800"
                            :href="short.url"
                            target="_blank"
                            rel="noopener noreferrer"
                        >{{ short.url }}</a>
                    </div>
                    <div class="truncate">
                        <span class="font-semibold">sURL: </span>
                        <a
                            class="text-purple-600 hover:text-purple-800"
                            :href="route('short-redirect', short)"
                            target="_blank"
                            rel="noopener noreferrer"
                        >{{ route('short-redirect', short) }}</a>
                    </div>
                    <div class="text-gray-600">
                        <span class="font-semibold text-gray-700">Created: </span>
                        {{ short.created_at }} -
                        <span class="font-semibold text-gray-700">Last Updated: </span>
                        {{ short.updated_at }}
                    </div>
                </div>

                <jet-section-border></jet-section-border>

                <div class="text-gray-600" v-if="clicks.data.length">
                    <p class="mb-2 text-lg font-semibold text-gray-700">Clicked {{ clicks.total }} time(s):</p>

                    <Paginator :paginator="clicks" />

                    <ul class="list-disc ml-6">
                        <li v-for="click in clicks.data" :key="click.id">
                            {{ click.created_at }}
                        </li>
                    </ul>
                </div>

                <div v-else>
                    <span class="text-gray-600">"{{ short.title }}" has no click history...</span>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Paginator from '@/Components/Paginator'
    import JetSectionBorder from '@/Jetstream/SectionBorder'

    export default {
        props: {
            short: Object,
            collection: Object,
            clicks: Object,
        },
        components: {
            AppLayout,
            Paginator,
            JetSectionBorder,
        }
    }
</script>