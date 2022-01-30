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

    export default {
        props: {
            saves: Object,
        },

        components: {
            AppLayout,
            Paginator,
            Saved,
        }
    }
</script>