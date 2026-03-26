<script setup>
import { Head, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    products: Array,
});

const quantities = ref({});

props.products.forEach(p => {
    quantities.value[p.id] = 1;
});

function addToCart(productId) {
    const form = useForm({
        product_id: productId,
        quantity: quantities.value[productId] || 1,
    });
    form.post(route('cart.add'), { preserveScroll: true });
}
</script>

<template>
    <Head title="Pood" />

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
                        <a :href="route('shop.index')" class="text-gray-900 font-medium">Pood</a>
                        <a :href="route('movies.index')" class="text-gray-500 hover:text-gray-700">Filmid</a>
                    </div>
                    <a :href="route('cart.index')" class="relative text-gray-600 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                        </svg>
                        <span v-if="$page.props.cartCount > 0"
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                            {{ $page.props.cartCount }}
                        </span>
                    </a>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">E-pood</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="product in products" :key="product.id"
                    class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                    <img :src="product.image" :alt="product.name" class="w-full h-48 object-cover" />
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-gray-800">{{ product.name }}</h3>
                        <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ product.description }}</p>
                        <p class="text-2xl font-bold text-indigo-600 mt-3">{{ product.price.toFixed(2) }} €</p>

                        <div class="flex items-center space-x-3 mt-4">
                            <label class="text-sm text-gray-500">Kogus:</label>
                            <select v-model="quantities[product.id]"
                                class="rounded-lg border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option v-for="n in 10" :key="n" :value="n">{{ n }}</option>
                            </select>
                        </div>

                        <button @click="addToCart(product.id)"
                            class="w-full mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition">
                            Lisa ostukorvi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
