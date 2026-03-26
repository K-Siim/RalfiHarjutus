<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';

const props = defineProps({
    movie: Object,
});

const form = useForm({
    _method: 'PUT',
    title: props.movie.title,
    description: props.movie.description,
    director: props.movie.director,
    release_year: props.movie.release_year,
    genre: props.movie.genre || '',
    rating: props.movie.rating || '',
    image: null,
});

function submit() {
    form.post(route('movies.update', props.movie.id), {
        forceFormData: true,
    });
}
</script>

<template>
    <Head title="Muuda filmi" />

    <div class="min-h-screen bg-gray-50">
        <!-- Nav -->
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center space-x-8">
                        <a :href="route('dashboard')" class="text-gray-800 font-bold text-lg">Hajusrakendused</a>
                        <a :href="route('movies.index')" class="text-gray-900 font-medium">Filmid</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <Link :href="route('movies.show', movie.id)" class="text-indigo-600 hover:underline text-sm mb-6 inline-block">
                ← Tagasi filmi juurde
            </Link>

            <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-100">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Muuda filmi</h1>

                <!-- Show current image -->
                <div v-if="movie.image" class="mb-4">
                    <img :src="movie.image.startsWith('http') ? movie.image : '/storage/' + movie.image"
                        :alt="movie.title" class="h-32 object-cover rounded-lg" />
                </div>

                <form @submit.prevent="submit" class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pealkiri *</label>
                        <input v-model="form.title" type="text" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                        <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kirjeldus *</label>
                        <textarea v-model="form.description" rows="5" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        <div v-if="form.errors.description" class="text-red-500 text-sm mt-1">{{ form.errors.description }}</div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Režissöör *</label>
                            <input v-model="form.director" type="text" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                            <div v-if="form.errors.director" class="text-red-500 text-sm mt-1">{{ form.errors.director }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Aasta *</label>
                            <input v-model="form.release_year" type="number" min="1888" max="2030" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                            <div v-if="form.errors.release_year" class="text-red-500 text-sm mt-1">{{ form.errors.release_year }}</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Žanr</label>
                            <input v-model="form.genre" type="text"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Hinnang (0-10)</label>
                            <input v-model="form.rating" type="number" min="0" max="10" step="0.1"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Uus pilt (valikuline)</label>
                        <input type="file" accept="image/*" @input="form.image = $event.target.files[0]"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                        <div v-if="form.errors.image" class="text-red-500 text-sm mt-1">{{ form.errors.image }}</div>
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
