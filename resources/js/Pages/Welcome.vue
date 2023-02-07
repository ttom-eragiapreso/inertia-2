<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

onMounted(() => {
    console.log();
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative flex items-top justify-center min-h-screen bg-space-500 dark:bg-gray-900 sm:items-center sm:pt-0"
    >
        <div
            v-if="canLogin"
            class="hidden fixed top-0 right-0 px-6 py-4 sm:block"
        >
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="text-sm text-gray-700 dark:text-gray-500 underline"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="text-sm text-white dark:text-gray-500 underline"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 text-sm text-white dark:text-gray-500 underline"
                    >Register</Link
                >
            </template>
        </div>

        <h1 class="text-3xl text-white">Welcome to your dream library</h1>
    </div>
</template>
