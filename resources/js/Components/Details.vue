<template>
    <div class="container-md mx-auto bg-space-300">
        <div
            class="shadow-md shadow-space-400 rounded-lg overflow-hidden flex bg-slate-300 max-h-[80%]"
        >
            <div>
                <img src="" class="max-h-full object-contain" alt="" />
            </div>

            <div class="card-details p-3">
                <h5 class="text-2xl mb-3">
                    <span class="text-mint-400">Title: </span>
                </h5>
                <h5 class="text-2xl mb-2">
                    <span class="text-mint-400">Author: </span>
                </h5>

                <h4 class="mt-2">Generi:</h4>
                <ul class="list-disc list-inside">
                    <li>Genere</li>
                </ul>
                <h4 class="mt-2">
                    L'hai aggiunta in data:
                    <span class="text-bold italic"></span>
                </h4>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    record: Object,
});
</script>
