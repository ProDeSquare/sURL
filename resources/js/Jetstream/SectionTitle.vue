<template>
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-xl font-medium text-gray-900">
                <slot name="title"></slot>
            </h3>

            <p class="mt-2 text-sm text-gray-600">
                <slot name="description"></slot>
            </p>
        </div>

        <div class="px-4 sm:px-0">
            <slot name="aside"></slot>
        </div>
    </div>
</template>
