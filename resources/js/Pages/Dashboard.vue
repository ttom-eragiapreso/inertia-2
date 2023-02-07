<script setup>
import Album from "@/Components/Album.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { onMounted, computed } from "vue";

onMounted(() => {});

let props = defineProps({
    user_library: Array,
});
</script>

<template>
    <Head title="Your Library" />

    <AuthenticatedLayout>
        <div
            class="container md:gap-x-4 mx-auto flex flex-wrap justify-around px-5 columns-2 md:columns-4 lg:columns-6"
        >
            <Album
                v-for="record in props.user_library"
                :key="record.id"
                :record="record"
            />
        </div>
    </AuthenticatedLayout>
</template>
