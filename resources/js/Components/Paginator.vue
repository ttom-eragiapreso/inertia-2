<template>
    <div class="flex">
        <div v-if="props.pagination.urls.first">
            <Link
                :href="route('pagination')"
                :data="{ link: props.pagination.urls.first }"
                >First Page</Link
            >
        </div>
        <div v-if="props.pagination.urls.next">
            <Link
                :href="route('pagination')"
                :data="{ link: props.pagination.urls.next }"
                >Next Page</Link
            >
        </div>
        <div v-if="props.pagination.urls.prev">
            <Link
                :href="route('pagination')"
                :data="{ link: props.pagination.urls.prev }"
                >Previous Page</Link
            >
        </div>
        <div v-if="props.pagination.urls.last">
            <Link
                :href="route('pagination')"
                :data="{ link: props.pagination.urls.last }"
                >Last Page</Link
            >
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

let props = defineProps({
    pagination: Object,
});
</script>
