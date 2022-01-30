<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight tracking-wide">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Paginator :paginator="shorts" />

                <div class="flex flex-wrap -mx-2">
                    <div class="w-full md:w-4/12 lg:w-3/12 px-2" v-for="short in shorts.data" :key="short.id">
                        <Short :short="short" />
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Paginator from '@/Components/Paginator'
    import Short from '@/Components/Short'

    export default {
        props: {
            shorts: Object
        },
        components: {
            AppLayout,
            Paginator,
            Short
        },
    }
</script>
