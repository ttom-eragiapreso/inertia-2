<script setup>
import Details from "@/Components/Details.vue";
import Album from "@/Components/Album.vue";
import Modal from "@/Components/Modal.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { onMounted, computed } from "vue";
import { ref } from "@vue/reactivity";

onMounted(() => {});

let props = defineProps({
    user_library: Array,
});
let showModal = ref(false);

let theOne = {};

function passDetails(record) {
    showModal = !showModal;
    theOne = record;
}
</script>

<template>
    <Head title="Your Library" />

    <AuthenticatedLayout>
        <!-- <Modal :show="showModal" @close="showModal = false">
            <Details v-if="showModal" />
        </Modal> -->
        <div
            class="container md:gap-x-4 mx-auto flex flex-wrap justify-around px-5 columns-2 md:columns-4 lg:columns-6"
        >
            <Album
                v-for="record in props.user_library"
                :key="record.id"
                :record="record"
                @modal-show="showModal = !showModal"
            />
        </div>
    </AuthenticatedLayout>
</template>
