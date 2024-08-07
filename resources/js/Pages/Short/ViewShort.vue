<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight tracking-wide truncate">
                {{ short.title }}
            </h2>
        </template>

        <div class="py-6 lg:py-8">
            <div class="max-w-7xl mx-auto px-4 lg:px-8">
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

                    <div class="text-gray-600 lg:flex">
                        <div>
                            <span class="font-semibold text-gray-700">Created: </span>
                            {{ formatDate(short.created_at) }}
                        </div>
                        <div class="mx-1 hidden lg:block">-</div>
                        <div>
                            <span class="font-semibold text-gray-700">Last Updated: </span>
                            {{ formatDate(short.updated_at) }}
                        </div>
                    </div>

                    <div class="text-gray-600" v-if="collection">
                        <span class="font-semibold text-gray-700">Collection: </span>
                        <Link
                            :href="route('dashboard', { collection: collection.id, name: collection.name })"
                            class="text-purple-600 hover:text-purple-800"
                        >
                            {{ collection.name }}
                        </Link>
                    </div>

                    <div class="text-gray-600">
                        <span class="font-semibold text-gray-700">Active: </span>
                        {{ short.enabled ? "Yes" : "No" }}
                    </div>

                    <div class="mt-6">
                        <Link :href="route('short-options', { short: short.hash })" title="Edit Link">
                            <jet-button>Edit Link</jet-button>
                        </Link>
                    </div>
                </div>

                <jet-section-border></jet-section-border>

                <div class="text-gray-600 mt-6 lg:mt-0" v-if="clicks.data.length">
                    <p class="mb-2 text-lg font-semibold text-gray-700">Clicked {{ clicks.total }} time(s):</p>

                    <Paginator :paginator="clicks" />

                    <ul class="list-disc ml-6 mt-4 lg:mt-0">
                        <li v-for="click in clicks.data" :key="click.id">
                            {{ formatDate(click.created_at) }}
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
    import JetButton from '@/Jetstream/Button'
    import AppLayout from '@/Layouts/AppLayout'
    import Paginator from '@/Components/Paginator'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import { Link } from '@inertiajs/vue3'
    import moment from 'moment'

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
            JetButton,
            Link,
        },
        methods: {
            formatDate: date => moment(date).format("LLL")
        }
    }
</script>