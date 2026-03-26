<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    order: Object,
});
</script>

<template>
    <Head title="Tellimus kinnitatud" />

    <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4">
        <div class="max-w-lg w-full">
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                <div class="text-6xl mb-4">✅</div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Makse õnnestus!</h1>
                <p class="text-gray-500 mb-6">Täname ostu eest. Sinu tellimus on edukalt registreeritud.</p>

                <div class="bg-gray-50 rounded-xl p-5 text-left mb-6">
                    <h3 class="font-semibold text-gray-700 mb-3">Tellimuse info</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Tellimuse nr:</span>
                            <span class="font-medium">#{{ order.id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Nimi:</span>
                            <span>{{ order.first_name }} {{ order.last_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">E-post:</span>
                            <span>{{ order.email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Makseviis:</span>
                            <span class="capitalize">{{ order.payment_method }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Makse ID:</span>
                            <span class="font-mono text-xs">{{ order.payment_id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Staatus:</span>
                            <span class="text-green-600 font-medium">Makstud</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 mt-3 pt-3">
                        <h4 class="font-medium text-gray-700 mb-2">Tooted:</h4>
                        <div v-for="item in order.items" :key="item.id" class="flex justify-between text-sm">
                            <span>{{ item.product?.name }} × {{ item.quantity }}</span>
                            <span>{{ (item.price * item.quantity).toFixed(2) }} €</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 mt-3 pt-3 flex justify-between font-bold">
                        <span>Kokku:</span>
                        <span class="text-indigo-600">{{ parseFloat(order.total).toFixed(2) }} €</span>
                    </div>
                </div>

                <Link :href="route('shop.index')"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-3 rounded-lg transition">
                    Tagasi poodi
                </Link>
            </div>
        </div>
    </div>
</template>
