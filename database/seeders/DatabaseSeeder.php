<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $products = [
            ['name' => 'Juhtmevabad kõrvaklapid', 'description' => 'Kvaliteetsed Bluetooth kõrvaklapid mürasummutusega. Aku kestab kuni 30 tundi.', 'price' => 79.99, 'image' => 'https://picsum.photos/seed/headphones/400/400'],
            ['name' => 'Nutitelefoni hoidik', 'description' => 'Universaalne autosse kinnitatav nutitelefoni hoidik magnetkinnitusega.', 'price' => 14.99, 'image' => 'https://picsum.photos/seed/holder/400/400'],
            ['name' => 'USB-C kaabel 2m', 'description' => 'Vastupidav punutud USB-C kiirlaadimiskaabel, 2 meetrit pikk.', 'price' => 9.99, 'image' => 'https://picsum.photos/seed/cable/400/400'],
            ['name' => 'Bluetooth kõlar', 'description' => 'Kaasaskantav veekindel Bluetooth kõlar suurepärase helikvaliteediga.', 'price' => 49.99, 'image' => 'https://picsum.photos/seed/speaker/400/400'],
            ['name' => 'Sülearvuti kott', 'description' => '15.6-tolline sülearvuti kott pehmendatud sisemise voodriga ja taskutega.', 'price' => 29.99, 'image' => 'https://picsum.photos/seed/laptopbag/400/400'],
            ['name' => 'Hiirepadja', 'description' => 'Ergonoomiline hiirepadja randmetoega, libisemiskindla põhjaga.', 'price' => 12.99, 'image' => 'https://picsum.photos/seed/mousepad/400/400'],
            ['name' => 'Veebikaamera HD', 'description' => '1080p Full HD veebikaamera sisseehitatud mikrofoniga, ideaalne videokõnedeks.', 'price' => 39.99, 'image' => 'https://picsum.photos/seed/webcam/400/400'],
            ['name' => 'Mehaaniline klaviatuur', 'description' => 'RGB taustvalgustusega mehaaniline klaviatuur, Cherry MX lülititega.', 'price' => 89.99, 'image' => 'https://picsum.photos/seed/keyboard/400/400'],
            ['name' => 'Akupank 20000mAh', 'description' => 'Suur mahutavusega akupank kahe USB väljundiga ja kiirlaadimise toega.', 'price' => 34.99, 'image' => 'https://picsum.photos/seed/powerbank/400/400'],
            ['name' => 'Monitor 27"', 'description' => '27-tolline 4K IPS monitor, USB-C ühendusega ja kõrguse reguleerimisega.', 'price' => 349.99, 'image' => 'https://picsum.photos/seed/monitor/400/400'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
