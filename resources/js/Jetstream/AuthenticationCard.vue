<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white border overflow-hidden sm:rounded-lg">
            <div class="flex justify-center my-4">
                <div>
                    <slot name="logo" />
                </div>
            </div>

            <slot />
        </div>
    </div>
</template>
