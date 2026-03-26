<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    movies: Array,
    genres: Array,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const genre = ref(props.filters?.genre || '');
const sort = ref(props.filters?.sort || 'created_at');
const direction = ref(props.filters?.direction || 'desc');

function applyFilters() {
    router.get(route('movies.index'), {
        search: search.value || undefined,
        genre: genre.value || undefined,
        sort: sort.value,
        direction: direction.value,
    }, { preserveState: true });
}

function clearFilters() {
    search.value = '';
    genre.value = '';
    sort.value = 'created_at';
    direction.value = 'desc';
    router.get(route('movies.index'));
}

function deleteMovie(id) {
    if (confirm('Kas oled kindel, et soovid selle filmi kustutada?')) {
        router.delete(route('movies.destroy', id));
    }
}
</script>

<template>
    <Head title="Filmid" />

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
                    <div v-if="$page.props.auth.user">
                        <Link :href="route('movies.create')"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition">
                            + Lisa film
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Filmid</h1>
                <a href="/api/movies" target="_blank"
                    class="text-sm text-indigo-600 hover:underline">API →</a>
            </div>

            <!-- Filters -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-8">
                <div class="flex flex-wrap items-end gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Otsi</label>
                        <input v-model="search" type="text" placeholder="Otsi pealkirja järgi..."
                            @keyup.enter="applyFilters"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>
                    <div class="w-40">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Žanr</label>
                        <select v-model="genre" @change="applyFilters"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Kõik</option>
                            <option v-for="g in genres" :key="g" :value="g">{{ g }}</option>
                        </select>
                    </div>
                    <div class="w-40">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sorteeri</label>
                        <select v-model="sort" @change="applyFilters"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="created_at">Lisamise aeg</option>
                            <option value="title">Pealkiri</option>
                            <option value="release_year">Aasta</option>
                            <option value="rating">Hinnang</option>
                        </select>
                    </div>
                    <div class="w-32">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Suund</label>
                        <select v-model="direction" @change="applyFilters"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="desc">Kahanev</option>
                            <option value="asc">Kasvav</option>
                        </select>
                    </div>
                    <button @click="applyFilters"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition">
                        Otsi
                    </button>
                    <button @click="clearFilters"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium transition">
                        Tühjenda
                    </button>
                </div>
            </div>

            <!-- Movies Grid -->
            <div v-if="movies.length === 0" class="text-center py-20 text-gray-400">
                <p class="text-xl">Filme pole veel lisatud.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="movie in movies" :key="movie.id"
                    class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                    <Link :href="route('movies.show', movie.id)">
                        <img v-if="movie.image" :src="movie.image.startsWith('http') ? movie.image : '/storage/' + movie.image"
                            :alt="movie.title" class="w-full h-48 object-cover" />
                        <div v-else class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                            </svg>
                        </div>
                    </Link>
                    <div class="p-5">
                        <Link :href="route('movies.show', movie.id)">
                            <h3 class="text-lg font-semibold text-gray-800 hover:text-indigo-600">{{ movie.title }}</h3>
                        </Link>
                        <p class="text-gray-500 text-sm mt-1">{{ movie.director }} · {{ movie.release_year }}</p>
                        <div class="flex items-center mt-2">
                            <span v-if="movie.genre" class="bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded-full">{{ movie.genre }}</span>
                            <span v-if="movie.rating" class="ml-2 text-yellow-500 font-medium text-sm">⭐ {{ movie.rating }}/10</span>
                        </div>
                        <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ movie.description }}</p>

                        <!-- Edit/Delete for owner -->
                        <div v-if="$page.props.auth.user?.id === movie.user_id" class="flex space-x-3 mt-3 pt-3 border-t border-gray-100">
                            <Link :href="route('movies.edit', movie.id)"
                                class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Muuda</Link>
                            <button @click="deleteMovie(movie.id)"
                                class="text-red-600 hover:text-red-800 text-sm font-medium">Kustuta</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- API Documentation -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mt-12">
                <h2 class="text-xl font-bold text-gray-800 mb-4">API dokumentatsioon</h2>
                <div class="space-y-4 text-sm">
                    <div>
                        <code class="bg-gray-100 px-2 py-1 rounded text-indigo-600">GET /api/movies</code>
                        <p class="text-gray-600 mt-1">Tagastab kõik filmid. Toetab järgmisi parameetreid:</p>
                        <ul class="list-disc ml-6 text-gray-500 mt-1">
                            <li><code>search</code> — otsing pealkirja järgi</li>
                            <li><code>genre</code> — filtreeri žanri järgi</li>
                            <li><code>director</code> — filtreeri režissööri järgi</li>
                            <li><code>year</code> — filtreeri aasta järgi</li>
                            <li><code>sort</code> — sorteeri (title, release_year, rating, created_at, director)</li>
                            <li><code>direction</code> — suund (asc, desc)</li>
                            <li><code>limit</code> — piira tagastatavate kirjete arvu</li>
                        </ul>
                    </div>
                    <div>
                        <code class="bg-gray-100 px-2 py-1 rounded text-indigo-600">GET /api/movies/{id}</code>
                        <p class="text-gray-600 mt-1">Tagastab ühe filmi andmed.</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="font-medium text-gray-700 mb-2">Näidispäringud:</p>
                        <code class="block text-xs text-gray-600">GET /api/movies?search=batman&sort=rating&direction=desc&limit=5</code>
                        <code class="block text-xs text-gray-600 mt-1">GET /api/movies?genre=Action&year=2024</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
