<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    post: Object,
});

const form = useForm({
    title: props.post.title,
    description: props.post.description,
});

function submit() {
    form.put(route('blog.update', props.post.id));
}
</script>

<template>
    <Head title="Muuda postitust" />

    <div class="min-h-screen bg-gray-50">
        <!-- Nav -->
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center space-x-8">
                        <a :href="route('dashboard')" class="text-gray-800 font-bold text-lg">Hajusrakendused</a>
                        <a :href="route('weather.index')" class="text-gray-500 hover:text-gray-700">Ilm</a>
                        <a :href="route('map.index')" class="text-gray-500 hover:text-gray-700">Kaart</a>
                        <a :href="route('blog.index')" class="text-gray-900 font-medium">Blogi</a>
                        <a :href="route('shop.index')" class="text-gray-500 hover:text-gray-700">Pood</a>
                        <a :href="route('movies.index')" class="text-gray-500 hover:text-gray-700">Filmid</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <Link :href="route('blog.show', post.id)" class="text-indigo-600 hover:underline text-sm mb-6 inline-block">
                ← Tagasi postituse juurde
            </Link>

            <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-100">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Muuda postitust</h1>

                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pealkiri</label>
                        <input v-model="form.title" type="text" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                        <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sisu</label>
                        <textarea v-model="form.description" rows="10" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        <div v-if="form.errors.description" class="text-red-500 text-sm mt-1">{{ form.errors.description }}</div>
                    </div>

                    <button type="submit" :disabled="form.processing"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-3 rounded-lg transition">
                        Salvesta muudatused
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
