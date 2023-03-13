<template>
    <div class="bg-gray-100 flex content-center justify-center flex-wrap min-h-screen">
        <div class="max-w-6xl flex-1 mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="flex">
                    <div class="py-2 text-gray-800">
                        <Logo :classes="'w-10'" />
                    </div>

                    <div class="border-l flex-1 flex p-3 ml-3 content-center flex-wrap">
                        <h1 class="text-gray-700 text-xl">sURL | URL Shortener</h1>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="leading-wide text-gray-600">
                        sURL is a service that allows you to shorten your links, save them for future and share them with people. You can easily create unlimited custom links with sURL.
                    </p>

                    <div class="pt-3 sm:block">
                        <inertia-link v-if="$page.props.user" href="/dashboard" class="text-sm text-purple-600 underline">
                            Visit Dashboard
                        </inertia-link>

                        <template v-else>
                            <inertia-link :href="route('login')" class="text-purple-600 text-sm">
                                Log in
                            </inertia-link>

                            <inertia-link :href="route('register')" class="text-purple-600 ml-4 text-sm">
                                Register
                            </inertia-link>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
    import Logo from "@/Components/Icons/Logo"

    export default {
        components: {
            JetApplicationLogo,
            Logo,
        },
    }
</script>
