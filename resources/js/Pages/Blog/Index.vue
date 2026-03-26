<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    posts: Array,
});
</script>

<template>
    <Head title="Blogi" />

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
                    <div v-if="$page.props.auth.user">
                        <Link :href="route('blog.create')"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition">
                            + Uus postitus
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Blogi</h1>

            <div v-if="posts.length === 0" class="text-center py-20 text-gray-400">
                <p class="text-xl">Postitusi pole veel.</p>
                <Link v-if="$page.props.auth.user" :href="route('blog.create')"
                    class="text-indigo-600 hover:underline mt-2 inline-block">
                    Lisa esimene postitus →
                </Link>
            </div>

            <div class="space-y-6">
                <Link v-for="post in posts" :key="post.id" :href="route('blog.show', post.id)"
                    class="block bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 border border-gray-100">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h2 class="text-xl font-semibold text-gray-800 hover:text-indigo-600">{{ post.title }}</h2>
                            <p class="text-gray-500 mt-2 line-clamp-2">{{ post.description }}</p>
                            <div class="flex items-center mt-4 text-sm text-gray-400 space-x-4">
                                <span>{{ post.user?.name }}</span>
                                <span>{{ new Date(post.created_at).toLocaleDateString('et-EE') }}</span>
                                <span>{{ post.comments?.length || 0 }} kommentaari</span>
                            </div>
                        </div>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>
