<template>
    <Link :href="'/'">
        <svg class="w-12 text-gray-800 logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><g id="prodesquare-logo" transform="translate(0 0)"><path fill="currentColor" d="M243.3,687.294l.485-.28-.881-.509L787.193,372.623V157.942l0,0L926.98,238.556v53.454l0,0,0,0V453.235L521.995,686.785l265.2,152.937V651.888L926.98,571.276V918.438l-1.646.948,0,0L806.842,987.72l-19.649,11.332-1.644.948ZM139.789,842.058l0,0L0,761.444V546.765l404.985-233.55-265.2-152.936V348.112L0,428.724V81.562l1.646-.95h0L120.14,12.278,139.789.948,141.433,0,683.678,312.706l-.487.28.883.509L139.789,627.377ZM0,707.989l0,0ZM926.98,571.276h0ZM0,428.724H0Z" transform="translate(36.509 0)"></path></g></svg>
    </Link>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        Link,
    }
}
</script>
