<template>
    <h2 class="text-center text-xl">
        Here you can search music by artist name or by release title!
    </h2>

    <div class="container mx-auto text-center my-3">
        <form @submit.prevent="submit">
            <input
                v-model="form.artist"
                type="text"
                placeholder="Search by artist name"
                class="rounded mx-auto py-1 px-2"
            />
            <input
                v-model="form.release_title"
                type="text"
                placeholder="Search by release title"
                class="rounded mx-auto py-1 px-2"
            />
            <Link
                :href="route('searchApi')"
                as="button"
                class="p-2 bg-orange-700 rounded-md text-stone-300"
                :disabled="!form.release_title && !form.artist"
                :data="{
                    release_title: form.release_title,
                    artist: form.artist,
                }"
                >Search</Link
            >
        </form>
    </div>

    <!-- If there is pagination I show info about the number of results and how many pages -->
    <div v-if="props.pagination">
        <h2>
            Results found : {{ props.pagination.items }} for
            <span v-if="artist">Artist: {{ artist }}</span>
            <span v-if="release_title">Release Title: {{ release_title }}</span>
        </h2>
        <h3>
            Page: {{ props.pagination.page }} of {{ props.pagination.pages }}
        </h3>
    </div>

    <!-- If there are results, I print them here -->
    <div v-if="props.results" class="position-relative">
        <div
            class="container md:gap-x-4 mx-auto flex flex-wrap justify-around px-5 columns-2 md:columns-4 lg:columns-6"
        >
            <Album
                v-for="record in props.results"
                :key="record.id"
                :record="record"
            />
        </div>
    </div>

    <!-- I load the paginator component, only if a pagination comes from the search -->
    <Paginator v-if="props.pagination" :pagination="props.pagination" />
</template>

<script setup>
let form = reactive({
    release_title: "",
    artist: "",
});

let submit = () => {
    Inertia.post("/query", form);
};

let props = defineProps({
    results: Object,
    pagination: Object,
    artist: String,
    release_title: String,
});
</script>

<script>
import Album from "@/Components/Album.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { reactive, ref } from "@vue/reactivity";
import { Link } from "@inertiajs/vue3";
import Paginator from "@/Components/Paginator.vue";
import { computed, onMounted } from "@vue/runtime-core";
export default {
    layout: AuthenticatedLayout,
};
</script>
