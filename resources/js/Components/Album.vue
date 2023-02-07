<template>
    <div
        class="flex flex-col justify-between min-h-72 mb-28 p-3 bg-slate-300 shadow-lg shadow-space-700/80 rounded-xl transition ease-in-out delay-50 duration-300 hover:scale-110 hover:shadow-xl hover:shadow-space-700/90"
    >
        <div class="shadow-md shadow-slate-400 rounded-lg overflow-hidden">
            <img
                :src="record.cover_image || record.thumb"
                class="shrink-0 w-48 object-cover h-full max-w-full"
                :alt="record.title"
            />
        </div>

        <div class="w-48 rounded-b-xl h-auto text-center">
            <h5 class="text-black-500 mb-3">{{ record.title }}</h5>
            <h6 class="text-slate-600 mb-4">{{ record.author }}</h6>
            <div class="flex justify-center">
                <Link
                    class="bg-mint-500 p-2 text-bisque-50 rounded-xl hover:bg-mint-700"
                    as="button"
                    href="#"
                    :data="{ id: record.id }"
                >
                    More Info
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "@vue/reactivity";

defineProps({
    record: Object,
});

let getAuthor = (record) => {
    if (record.title.includes("-")) {
        let words = record.title.split("-");
        return words[0].trim();
    } else {
        return record.title;
    }
};

let getTitle = (record) => {
    if (record.title.includes("-")) {
        let words = record.title.split("-");
        return words[1].trim();
    } else {
        return record.title;
    }
};
</script>
