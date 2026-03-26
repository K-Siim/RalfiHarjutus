<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    movie: Object,
});

function deleteMovie() {
    if (confirm('Kas oled kindel, et soovid selle filmi kustutada?')) {
        router.delete(route('movies.destroy', props.movie.id));
    }
}
</script>

<template>
    <Head :title="movie.title" />

    <div class="min-h-screen bg-gray-50">
        <!-- Nav -->
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center space-x-8">
                        <a :href="route('dashboard')" class="text-gray-800 font-bold text-lg">Hajusrakendused</a>
                        <a :href="route('weather.index')" class="text-gray-500 hover:text-gray-700">Ilm</a>
                        <a :href="route('map.index')" class="text-gray-500 hover:text-gray-700">Kaart</a>
                        <a :href="route('blog.index')" class="text-gray-500 hover:text-gray-700">Blogi</a>
                        <a :href="route('shop.index')" class="text-gray-500 hover:text-gray-700">Pood</a>
                        <a :href="route('movies.index')" class="text-gray-900 font-medium">Filmid</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <Link :href="route('movies.index')" class="text-indigo-600 hover:underline text-sm mb-6 inline-block">
                ← Tagasi filmide juurde
            </Link>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <img v-if="movie.image"
                    :src="movie.image.startsWith('http') ? movie.image : '/storage/' + movie.image"
                    :alt="movie.title" class="w-full h-72 object-cover" />

                <div class="p-8">
                    <div class="flex items-start justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800">{{ movie.title }}</h1>
                            <div class="flex items-center space-x-4 mt-2 text-gray-500">
                                <span>{{ movie.director }}</span>
                                <span>{{ movie.release_year }}</span>
                                <span v-if="movie.genre" class="bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded-full">{{ movie.genre }}</span>
                            </div>
                        </div>
                        <div v-if="movie.rating" class="text-3xl font-bold text-yellow-500">
                            ⭐ {{ movie.rating }}
                        </div>
                    </div>

                    <div class="mt-6 text-gray-700 leading-relaxed whitespace-pre-wrap">{{ movie.description }}</div>

                    <div class="mt-6 text-sm text-gray-400">
                        <span>Lisatud: {{ movie.user?.name || 'Tundmatu' }}</span>
                        <span class="ml-4">{{ new Date(movie.created_at).toLocaleDateString('et-EE') }}</span>
                    </div>

                    <div v-if="$page.props.auth.user?.id === movie.user_id" class="flex space-x-3 mt-6 pt-4 border-t border-gray-100">
                        <Link :href="route('movies.edit', movie.id)"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition">
                            Muuda
                        </Link>
                        <button @click="deleteMovie"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition">
                            Kustuta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
