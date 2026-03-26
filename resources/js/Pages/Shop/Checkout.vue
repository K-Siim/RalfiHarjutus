<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    cartItems: Array,
    total: Number,
});

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    payment_method: 'stripe',
});

const paymentError = ref('');

function submit() {
    paymentError.value = '';
    form.post(route('cart.pay'), {
        onError: (errors) => {
            if (errors.payment) {
                paymentError.value = errors.payment;
            }
        },
    });
}
</script>

<template>
    <Head title="Maksmine" />

    <div class="min-h-screen bg-gray-50">
        <!-- Nav -->
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center space-x-8">
                        <a :href="route('dashboard')" class="text-gray-800 font-bold text-lg">Hajusrakendused</a>
                        <a :href="route('shop.index')" class="text-gray-900 font-medium">Pood</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <Link :href="route('cart.index')" class="text-indigo-600 hover:underline text-sm mb-6 inline-block">
                ← Tagasi ostukorvi
            </Link>

            <h1 class="text-3xl font-bold text-gray-800 mb-8">Maksmine</h1>

            <!-- Payment Error -->
            <div v-if="paymentError" class="bg-red-100 border border-red-400 text-red-700 rounded-xl p-4 mb-6">
                {{ paymentError }}
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Order Summary -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Tellimuse kokkuvõte</h2>
                    <div class="space-y-3">
                        <div v-for="item in cartItems" :key="item.product.id"
                            class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img :src="item.product.image" :alt="item.product.name"
                                    class="w-12 h-12 object-cover rounded" />
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">{{ item.product.name }}</p>
                                    <p class="text-xs text-gray-400">{{ item.quantity }} tk</p>
                                </div>
                            </div>
                            <p class="font-semibold text-gray-800">{{ (item.product.price * item.quantity).toFixed(2) }} €</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 mt-4 pt-4 flex justify-between">
                        <span class="text-lg font-semibold">Kokku:</span>
                        <span class="text-xl font-bold text-indigo-600">{{ total.toFixed(2) }} €</span>
                    </div>
                </div>

                <!-- Payment Form -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Makseandmed</h2>

                    <form @submit.prevent="submit" class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Eesnimi</label>
                                <input v-model="form.first_name" type="text" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                                <div v-if="form.errors.first_name" class="text-red-500 text-sm mt-1">{{ form.errors.first_name }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Perenimi</label>
                                <input v-model="form.last_name" type="text" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                                <div v-if="form.errors.last_name" class="text-red-500 text-sm mt-1">{{ form.errors.last_name }}</div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">E-post</label>
                            <input v-model="form.email" type="email" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                            <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Telefon</label>
                            <input v-model="form.phone" type="tel" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                            <div v-if="form.errors.phone" class="text-red-500 text-sm mt-1">{{ form.errors.phone }}</div>
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Makseviis</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label :class="[
                                    'flex items-center justify-center p-4 border-2 rounded-xl cursor-pointer transition',
                                    form.payment_method === 'stripe' ? 'border-indigo-500 bg-indigo-50' : 'border-gray-200 hover:border-gray-300'
                                ]">
                                    <input type="radio" v-model="form.payment_method" value="stripe" class="sr-only" />
                                    <div class="text-center">
                                        <div class="text-2xl mb-1">💳</div>
                                        <span class="font-medium text-sm">Stripe</span>
                                    </div>
                                </label>
                                <label :class="[
                                    'flex items-center justify-center p-4 border-2 rounded-xl cursor-pointer transition',
                                    form.payment_method === 'paypal' ? 'border-indigo-500 bg-indigo-50' : 'border-gray-200 hover:border-gray-300'
                                ]">
                                    <input type="radio" v-model="form.payment_method" value="paypal" class="sr-only" />
                                    <div class="text-center">
                                        <div class="text-2xl mb-1">🅿️</div>
                                        <span class="font-medium text-sm">PayPal</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <button type="submit" :disabled="form.processing"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition mt-4">
                            <span v-if="form.processing">Töötlemine...</span>
                            <span v-else>Maksa {{ total.toFixed(2) }} €</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
