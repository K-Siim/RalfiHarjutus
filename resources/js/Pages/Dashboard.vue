<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Tere tulemast! Vali rakendus:</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <Link :href="route('weather.index')"
                            class="block p-6 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl text-white hover:shadow-lg transition">
                            <div class="text-3xl mb-2">🌤️</div>
                            <h4 class="text-lg font-semibold">Ilmateade</h4>
                            <p class="text-blue-100 text-sm mt-1">Vaata ilmaennustust erinevate linnade kohta</p>
                        </Link>

                        <Link :href="route('map.index')"
                            class="block p-6 bg-gradient-to-br from-green-400 to-green-600 rounded-xl text-white hover:shadow-lg transition">
                            <div class="text-3xl mb-2">🗺️</div>
                            <h4 class="text-lg font-semibold">Kaardirakendus</h4>
                            <p class="text-green-100 text-sm mt-1">Lisa ja halda markereid kaardil</p>
                        </Link>

                        <Link :href="route('blog.index')"
                            class="block p-6 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl text-white hover:shadow-lg transition">
                            <div class="text-3xl mb-2">📝</div>
                            <h4 class="text-lg font-semibold">Blogi</h4>
                            <p class="text-purple-100 text-sm mt-1">Loe ja kirjuta blogipostitusi</p>
                        </Link>

                        <Link :href="route('shop.index')"
                            class="block p-6 bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl text-white hover:shadow-lg transition">
                            <div class="text-3xl mb-2">🛒</div>
                            <h4 class="text-lg font-semibold">E-pood</h4>
                            <p class="text-orange-100 text-sm mt-1">Sirvi tooteid ja tee tellimusi</p>
                        </Link>

                        <Link :href="route('movies.index')"
                            class="block p-6 bg-gradient-to-br from-red-400 to-red-600 rounded-xl text-white hover:shadow-lg transition">
                            <div class="text-3xl mb-2">🎬</div>
                            <h4 class="text-lg font-semibold">Filmid</h4>
                            <p class="text-red-100 text-sm mt-1">Lisa ja sirvi filme, kasuta API-t</p>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
