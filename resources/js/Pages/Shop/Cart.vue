<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    cartItems: Array,
});

const total = computed(() => {
    return props.cartItems.reduce((sum, item) => sum + item.product.price * item.quantity, 0);
});

function updateQuantity(productId, quantity) {
    router.patch(route('cart.update'), {
        product_id: productId,
        quantity: quantity,
    });
}

function removeItem(productId) {
    router.delete(route('cart.remove'), {
        data: { product_id: productId },
    });
}
</script>

<template>
    <Head title="Ostukorv" />

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
                </div>
            </div>
        </nav>

        <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <Link :href="route('shop.index')" class="text-indigo-600 hover:underline text-sm mb-6 inline-block">
                ← Tagasi poodi
            </Link>

            <h1 class="text-3xl font-bold text-gray-800 mb-8">Ostukorv</h1>

            <div v-if="cartItems.length === 0" class="text-center py-20 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                </svg>
                <p class="text-xl">Ostukorv on tühi.</p>
                <Link :href="route('shop.index')" class="text-indigo-600 hover:underline mt-2 inline-block">
                    Mine poodi →
                </Link>
            </div>

            <div v-else>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div v-for="item in cartItems" :key="item.product.id"
                        class="flex items-center p-5 border-b border-gray-100 last:border-b-0">
                        <img :src="item.product.image" :alt="item.product.name" class="w-20 h-20 object-cover rounded-lg" />
                        <div class="flex-1 ml-5">
                            <h3 class="font-semibold text-gray-800">{{ item.product.name }}</h3>
                            <p class="text-indigo-600 font-bold">{{ item.product.price.toFixed(2) }} €</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <select :value="item.quantity" @change="updateQuantity(item.product.id, parseInt($event.target.value))"
                                class="rounded-lg border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option v-for="n in 99" :key="n" :value="n">{{ n }}</option>
                            </select>
                            <p class="font-semibold text-gray-800 w-24 text-right">
                                {{ (item.product.price * item.quantity).toFixed(2) }} €
                            </p>
                            <button @click="removeItem(item.product.id)"
                                class="text-red-500 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Total & Checkout -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mt-6">
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-semibold text-gray-800">Kokku:</span>
                        <span class="text-2xl font-bold text-indigo-600">{{ total.toFixed(2) }} €</span>
                    </div>
                    <Link :href="route('cart.checkout')"
                        class="block w-full mt-4 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg text-center transition">
                        Osta kätte →
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
