<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    post: Object,
});

const commentForm = useForm({
    body: '',
});

function submitComment() {
    commentForm.post(route('comments.store', props.post.id), {
        onSuccess: () => commentForm.reset(),
    });
}

function deleteComment(id) {
    if (confirm('Kas oled kindel?')) {
        router.delete(route('comments.destroy', id));
    }
}

function deletePost() {
    if (confirm('Kas oled kindel, et soovid selle postituse kustutada?')) {
        router.delete(route('blog.destroy', props.post.id));
    }
}

const auth = ref(null);
</script>

<template>
    <Head :title="post.title" />

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
            <!-- Back -->
            <Link :href="route('blog.index')" class="text-indigo-600 hover:underline text-sm mb-6 inline-block">
                ← Tagasi blogisse
            </Link>

            <!-- Post -->
            <article class="bg-white rounded-xl shadow-sm p-8 border border-gray-100">
                <h1 class="text-3xl font-bold text-gray-800">{{ post.title }}</h1>
                <div class="flex items-center mt-3 text-sm text-gray-400 space-x-4">
                    <span>{{ post.user?.name }}</span>
                    <span>{{ new Date(post.created_at).toLocaleDateString('et-EE') }}</span>
                    <span v-if="post.updated_at !== post.created_at" class="italic">
                        Muudetud: {{ new Date(post.updated_at).toLocaleDateString('et-EE') }}
                    </span>
                </div>

                <!-- Actions -->
                <div v-if="$page.props.auth.user?.id === post.user_id" class="flex space-x-3 mt-4">
                    <Link :href="route('blog.edit', post.id)"
                        class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                        Muuda
                    </Link>
                    <button @click="deletePost" class="text-red-600 hover:text-red-800 text-sm font-medium">
                        Kustuta
                    </button>
                </div>

                <div class="mt-6 text-gray-700 leading-relaxed whitespace-pre-wrap">{{ post.description }}</div>
            </article>

            <!-- Comments Section -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">
                    Kommentaarid ({{ post.comments?.length || 0 }})
                </h2>

                <!-- Comment Form -->
                <div v-if="$page.props.auth.user" class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 mb-6">
                    <form @submit.prevent="submitComment">
                        <textarea v-model="commentForm.body" rows="3" placeholder="Lisa kommentaar..."
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required></textarea>
                        <div v-if="commentForm.errors.body" class="text-red-500 text-sm mt-1">{{ commentForm.errors.body }}</div>
                        <button type="submit" :disabled="commentForm.processing"
                            class="mt-3 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition">
                            Lisa kommentaar
                        </button>
                    </form>
                </div>
                <div v-else class="bg-gray-100 rounded-xl p-4 text-center text-gray-500 mb-6">
                    <Link :href="route('login')" class="text-indigo-600 hover:underline">Logi sisse</Link>,
                    et kommenteerida.
                </div>

                <!-- Comments List -->
                <div class="space-y-4">
                    <div v-for="comment in post.comments" :key="comment.id"
                        class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium text-gray-800">{{ comment.user?.name }}</p>
                                <p class="text-gray-400 text-xs">{{ new Date(comment.created_at).toLocaleDateString('et-EE') }}</p>
                            </div>
                            <!-- Delete comment: comment owner or post owner -->
                            <button
                                v-if="$page.props.auth.user && ($page.props.auth.user.id === comment.user_id || $page.props.auth.user.id === post.user_id)"
                                @click="deleteComment(comment.id)"
                                class="text-red-500 hover:text-red-700 text-sm">
                                Kustuta
                            </button>
                        </div>
                        <p class="text-gray-700 mt-2">{{ comment.body }}</p>
                    </div>
                </div>

                <div v-if="!post.comments?.length" class="text-center text-gray-400 py-6">
                    Kommentaare pole veel.
                </div>
            </div>
        </div>
    </div>
</template>
