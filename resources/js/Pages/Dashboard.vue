<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight tracking-wide">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Paginator :paginator="links" />

                <div class="flex flex-wrap -px-2">
                    <div class="w-full md:w-4/12 lg:w-3/12 p-2" v-for="link in links.data" :key="link.id">
                        <Link :link="link" />
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Paginator from '@/Components/Paginator'
    import Link from '@/Components/Link'

    export default {
        props: {
            links: Object
        },
        components: {
            AppLayout,
            Paginator,
            Link
        },
    }
</script>
