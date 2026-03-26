<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Movie;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'test@example.com')->first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Kui andmebaasis pole filme, lisame ~20 näidis-kirjet,
        // et `Filmid` leht oleks kohe sisuga.
        if (Movie::count() === 0) {
            $movies = [
                [
                    'title' => 'Nebula Drift',
                    'image' => 'https://picsum.photos/seed/movie-nebula-drift/600/400',
                    'description' => 'Kosmoselaev navigeerib ohtliku udupiirkonna kaudu, kus gravitatsioon käitub ettearvamatult.',
                    'director' => 'Marta Kask',
                    'release_year' => 2019,
                    'genre' => 'Sci-Fi',
                    'rating' => 8.4,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Clockwork Heart',
                    'image' => 'https://picsum.photos/seed/movie-clockwork-heart/600/400',
                    'description' => 'Romaanne lugu inimesest, kes avastab masinast ehitatud südame salajase loo.',
                    'director' => 'Rasmus Värav',
                    'release_year' => 2021,
                    'genre' => 'Romance',
                    'rating' => 7.7,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Midnight Courier',
                    'image' => 'https://picsum.photos/seed/movie-midnight-courier/600/400',
                    'description' => 'Salajane kuller toimetab pakke, mis avavad iga sihtkoha kohta uue müüdi.',
                    'director' => 'Liis Rand',
                    'release_year' => 2020,
                    'genre' => 'Thriller',
                    'rating' => 8.1,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Crimson Alley',
                    'image' => 'https://picsum.photos/seed/movie-crimson-alley/600/400',
                    'description' => 'Pimedad tänavad peidavad märkmeid minevikust, mis ähvardab linna taas vallandada.',
                    'director' => 'Joonas Sild',
                    'release_year' => 2017,
                    'genre' => 'Drama',
                    'rating' => 7.1,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Aurora Protocol',
                    'image' => 'https://picsum.photos/seed/movie-aurora-protocol/600/400',
                    'description' => 'Teadlased rikutud satelliitide andmeid kokku pannes ilmub taustale uus signaal.',
                    'director' => 'Katrin Mägi',
                    'release_year' => 2022,
                    'genre' => 'Action',
                    'rating' => 8.8,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'The Last Meadow',
                    'image' => 'https://picsum.photos/seed/movie-the-last-meadow/600/400',
                    'description' => 'Pärast linnast lahkumist leiab pere koha, kus loodus mäletab kõiki lugusid.',
                    'director' => 'Teet Saar',
                    'release_year' => 2016,
                    'genre' => 'Adventure',
                    'rating' => 7.9,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Laughing Machinery',
                    'image' => 'https://picsum.photos/seed/movie-laughing-machinery/600/400',
                    'description' => 'Koomiline eksperiment, mis paneb robotid teesklema, et neil on tunded.',
                    'director' => 'Anu Põld',
                    'release_year' => 2018,
                    'genre' => 'Comedy',
                    'rating' => 7.3,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Glass Fortress',
                    'image' => 'https://picsum.photos/seed/movie-glass-fortress/600/400',
                    'description' => 'Ehitise sees peituv turvasüsteem hakkab kaitsma enda loodud mälestusi.',
                    'director' => 'Markus Kivi',
                    'release_year' => 2023,
                    'genre' => 'Horror',
                    'rating' => 8.0,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Starlight Syndicate',
                    'image' => 'https://picsum.photos/seed/movie-starlight-syndicate/600/400',
                    'description' => 'Salaselts manipuleerib tähtede liikumisega, et mõjutada inimeste valikuid.',
                    'director' => 'Helene Allik',
                    'release_year' => 2015,
                    'genre' => 'Fantasy',
                    'rating' => 7.8,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Greenline Express',
                    'image' => 'https://picsum.photos/seed/movie-greenline-express/600/400',
                    'description' => 'Kiirrong sõidab läbi piirkonna, kus aeg läheb käima ainult jaamades.',
                    'director' => 'Sander Laid',
                    'release_year' => 2024,
                    'genre' => 'Sci-Fi',
                    'rating' => 9.1,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Silver Screen Myth',
                    'image' => 'https://picsum.photos/seed/movie-silver-screen-myth/600/400',
                    'description' => 'Vanad filmireklaamid ärkavad ellu ja näitavad, kes oli tõeline kangelane.',
                    'director' => 'Elina Toom',
                    'release_year' => 2014,
                    'genre' => 'Drama',
                    'rating' => 6.9,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Thunder & Tartan',
                    'image' => 'https://picsum.photos/seed/movie-thunder-tartan/600/400',
                    'description' => 'Seiklused mägedes ja tormides viivad kaks võõrast lõpuks samale sihile.',
                    'director' => 'Gunnar Mänd',
                    'release_year' => 2020,
                    'genre' => 'Adventure',
                    'rating' => 8.2,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Electric Bloom',
                    'image' => 'https://picsum.photos/seed/movie-electric-bloom/600/400',
                    'description' => 'Linnas hakkavad õitsema nähtamatud taimed, mis jätavad endast helendavad jäljed.',
                    'director' => 'Kaisa Eller',
                    'release_year' => 2019,
                    'genre' => 'Fantasy',
                    'rating' => 7.5,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Redacted Memories',
                    'image' => 'https://picsum.photos/seed/movie-redacted-memories/600/400',
                    'description' => 'Arhiivist leitakse kaust, mille sisu on salastatud ka tulevikus.',
                    'director' => 'Peeter Kõiv',
                    'release_year' => 2021,
                    'genre' => 'Thriller',
                    'rating' => 8.6,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Citrus Comet',
                    'image' => 'https://picsum.photos/seed/movie-citrus-comet/600/400',
                    'description' => 'Komnati sisse kukkuv valgusvihk paneb kogu linna üheks päevaks teist moodi mõtlema.',
                    'director' => 'Maris Vilt',
                    'release_year' => 2018,
                    'genre' => 'Comedy',
                    'rating' => 7.0,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Night Runner',
                    'image' => 'https://picsum.photos/seed/movie-night-runner/600/400',
                    'description' => 'Jooksja saab teate, mis viib teda mööda tänavaid, kus valgust kasutatakse relvana.',
                    'director' => 'Rene Linna',
                    'release_year' => 2022,
                    'genre' => 'Action',
                    'rating' => 8.3,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Hollow Lullaby',
                    'image' => 'https://picsum.photos/seed/movie-hollow-lullaby/600/400',
                    'description' => 'Hällilaul, mis kostub alles pärast vaikust, toob kaasa kummalise tagasipöördumise.',
                    'director' => 'Kristjan Saar',
                    'release_year' => 2016,
                    'genre' => 'Horror',
                    'rating' => 7.6,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Paper Lanterns',
                    'image' => 'https://picsum.photos/seed/movie-paper-lanterns/600/400',
                    'description' => 'Festivalil antud lubadused ei kao - need muutuvad nähtavaks alles siis, kui keegi loobub.',
                    'director' => 'Signe Luik',
                    'release_year' => 2017,
                    'genre' => 'Romance',
                    'rating' => 7.4,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Iron Orchestra',
                    'image' => 'https://picsum.photos/seed/movie-iron-orchestra/600/400',
                    'description' => 'Metallist valmistatud orkester esitab muusikat, mis suudab muuta maastiku vormi.',
                    'director' => 'Viktor Kroon',
                    'release_year' => 2023,
                    'genre' => 'Sci-Fi',
                    'rating' => 8.7,
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Tide of Tomorrow',
                    'image' => 'https://picsum.photos/seed/movie-tide-of-tomorrow/600/400',
                    'description' => 'Merelained toovad kaldale sündmused, mis juhtuvad alles mitme aasta pärast.',
                    'director' => 'Nele Pärn',
                    'release_year' => 2024,
                    'genre' => 'Drama',
                    'rating' => 9.0,
                    'user_id' => $user->id,
                ],
            ];

            foreach ($movies as $movie) {
                Movie::create($movie);
            }
        }

        // Kui andmebaasis pole blogipostitusi, lisame mõned näited,
        // et `Blogi` leht poleks tühi.
        if (Post::count() === 0) {
            $posts = [
                [
                    'title' => 'Minu esimene filmisoovitus: “Nebula Drift”',
                    'description' => 'See film õpetas mulle, et parimad seiklused algavad siis, kui võtad riski ja lased end näha uutel kaartidel.',
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Kuidas kirjutada blogipostitust, mis jääb meelde',
                    'description' => 'Sisu ei pea olema pikk, aga peab olema konkreetne: alusta küsimusega, anna 1–2 näidet ja lõpeta lühikese kokkuvõttega.',
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Filmitabelid ja väikesed harjutused',
                    'description' => 'Minu lemmik on teha endale väikesed mini-ülesanded: üks tabel, üks otsing, üks filter—ja siis vaatad, kuidas see reaalselt tööle hakkab.',
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Romantika, mis ei tule liiga vara',
                    'description' => '“Clockwork Heart” meenutas mulle, et tunnetel on ajastus: kui lugu jõuab sinuni õiges järjekorras, muutub kõik lihtsamaks.',
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Thrilleri rütm: pinge läbi detaili',
                    'description' => 'Hea thriller ei sõida ainult tempo peal—see elab detailides, millele sa alles tagantjärele mõtled.',
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Kas Sci-Fi peab olema tehniline?',
                    'description' => 'Ei pea. Sci‑Fi võib olla ka emotsioon: kuidas inimesed reageerivad uuele maailmale, mida nad kohe ei mõista.',
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Koomia näitab, kas teed õigeid asju',
                    'description' => 'Naer tuleb tihti siis, kui tegelased teevad midagi “liiga tõsiselt”—ja sina saad lõpuks aru, et see oli just õige lähenemine.',
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Hirm ja valgus',
                    'description' => '“Glass Fortress” näitab, kuidas hirm võib peituda rahulikus raamis. Mõnikord on parim efekt see, mis ei plahvata kohe.',
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Mis on hea kirjeldus?',
                    'description' => 'Kirjeldus peaks tekitama pildi: kelle lugu see on, mis olukorras nad on ja miks see on oluline. Üks lõik on tihti piisav.',
                    'user_id' => $user->id,
                ],
                [
                    'title' => 'Minu “Tide of Tomorrow” lemmikhetk',
                    'description' => 'Kõige rohkem meeldib mulle, kuidas lugu ei kiirusta. Mõned asjad saavad päriselt kokku alles siis, kui ootad.',
                    'user_id' => $user->id,
                ],
            ];

            foreach ($posts as $post) {
                Post::create($post);
            }
        }

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
