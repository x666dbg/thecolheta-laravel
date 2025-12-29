<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    private function getCategoryId(string $name)
    {
        $id = Category::where('name', $name)->value('id');

        if (!$id) {
            throw new \Exception("Category '$name' not found. Jalankan CategorySeeder dulu.");
        }

        return $id;
    }

    public function run(): void
    {
        // Ambil semua ID subkategori yang dibutuhin
        $photoPrintingId = $this->getCategoryId('Photo Printing Cake');
        $characterCakeId = $this->getCategoryId('Character Cake');
        $koreanCakeId    = $this->getCategoryId('Korean Cake');
        $regularCakeId   = $this->getCategoryId('Regular Cake');
        $weddingCakeId   = $this->getCategoryId('Wedding Cake');

        $cookiesId  = $this->getCategoryId('Cookies');

        $bordFlowerId     = $this->getCategoryId('Bord Flower');
        $handBucketId     = $this->getCategoryId('Hand Bucket');
        $standingFlowerId = $this->getCategoryId('Standing Flower');
        $tableFlowerId    = $this->getCategoryId('Table Flower');

        $hampersImlekId   = $this->getCategoryId('Hampers Imlek');
        $hampersKemarikId = $this->getCategoryId('Hampers Kemarik');
        $hampersNatalId   = $this->getCategoryId('Hampers Natal');
        $hampersLebaranId = $this->getCategoryId('Hampers Lebaran');

        $balonHBId  = $this->getCategoryId('Balon Happy Birthday');
        $lilinId    = $this->getCategoryId('Lilin');
        $ornamentId = $this->getCategoryId('Ornament');

        // Lu bisa tambahin lebih banyak kategori kalau mau.
        
        $products = [

            // PHOTOPRINTINGCAKE
            [
                'category_id' => $photoPrintingId,
                'name' => 'Photo Printing Cake HBD Refal',
                'description' => 'Kue coklat lembut dengan krim lezat.',
                'image_url' => '/cakedecor/FotoPrintingCake Refal Hadi.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 410000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $photoPrintingId,
                'name' => 'Photo Printing Cake HBD Istriku',
                'description' => 'Cupcake vanilla dengan topping buttercream.',
                'image_url' => '/cakedecor/FotoPrintingCake HBD Istriku.jpg',
                'variants' => [
                    ['size' => 'D.20cm', 'price' => 410000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $photoPrintingId,
                'name' => 'Photo Printing Cake Bang Reza',
                'description' => 'Cupcake rasa stroberi segar.',
                'image_url' => '/cakedecor/FotoPrintingCake Bang Reza.jpg',
                'variants' => [
                    ['size' => 'D.20cm', 'price' => 410000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $photoPrintingId,
                'name' => 'Photo Printing Cake Elza Frozen',
                'description' => 'Cupcake rasa stroberi segar.',
                'image_url' => '/cakedecor/FotoPrintingCake Elza.jpg',
                'variants' => [
                    ['size' => '30x20cm', 'price' => 639000, 'stock' => 10],
                ],
            ],

            // CHARACTERCAKE
            [
                'category_id' => $characterCakeId,
                'name' => 'Character Cake Spider Man',
                'description' => 'Kue karakter Spider Man.',
                'image_url' => '/cakedecor/CharacterCake Spider Man.jpg',
                'variants' => [
                    ['size' => 'D.20cm', 'price' => 445000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $characterCakeId,
                'name' => 'Character Cake No Jutek',
                'description' => 'Kue karakter No Jutek.',
                'image_url' => '/cakedecor/CharacterCake No Jutek.jpg',
                'variants' => [
                    ['size' => 'D.20cm', 'price' => 445000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $characterCakeId,
                'name' => 'Character Cake Ferrari',
                'description' => 'Kue karakter Ferrari.',
                'image_url' => '/cakedecor/CharacterCake Ferrari.jpg',
                'variants' => [
                    ['size' => '30x20cm', 'price' => 675000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $characterCakeId,
                'name' => 'Character Cake Dokter',
                'description' => 'Kue karakter Dokter.',
                'image_url' => '/cakedecor/CharacterCake Dokter.jpg',
                'variants' => [
                    ['size' => 'D.20cm', 'price' => 445000, 'stock' => 10],
                ],
            ],

            // KOREANCAKE LUPA HARGA
            [
                'category_id' => $koreanCakeId,
                'name' => 'Korean Cake Chocolate Sensation',
                'description' => 'Kue Korean Cake rasa coklat lembut.',
                'image_url' => '/cakekorean/Chocolate Sensation Cake.jpg',
                'variants' => [
                    ['size' => '40x60', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $koreanCakeId,
                'name' => 'Korean Cake Chocolate Strawberry',
                'description' => 'Korean Cake rasa coklat strawberry.',
                'image_url' => '/cakekorean/Chocolate Strawbeery Cake.jpg',
                'variants' => [
                    ['size' => '40x60', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $koreanCakeId,
                'name' => 'Korean Cake Classic Chocolate',
                'description' => 'Korean Cake coklat klasik.',
                'image_url' => '/cakekorean/Clasic Chocolate Cake.jpg',
                'variants' => [
                    ['size' => '40x60', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $koreanCakeId,
                'name' => 'Korean Cake Coffee Latte',
                'description' => 'Korean Cake rasa kopi latte.',
                'image_url' => '/cakekorean/Coffee Late Cake.jpg',
                'variants' => [
                    ['size' => '40x60', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $koreanCakeId,
                'name' => 'Korean Cake Easy Blueberry',
                'description' => 'Korean Cake blueberry lembut.',
                'image_url' => '/cakekorean/Easy Blueberry Cake.jpg',
                'variants' => [
                    ['size' => '40x60', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $koreanCakeId,
                'name' => 'Korean Cake Lychee',
                'description' => 'Korean Cake rasa leci segar.',
                'image_url' => '/cakekorean/Lychee Cake.jpg',
                'variants' => [
                    ['size' => '40x60', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $koreanCakeId,
                'name' => 'Korean Cake Mango',
                'description' => 'Korean Cake mangga manis.',
                'image_url' => '/cakekorean/Mango Cake.jpg',
                'variants' => [
                    ['size' => '40x60', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $koreanCakeId,
                'name' => 'Korean Cake Mom Vanilla',
                'description' => 'Korean Cake vanilla lembut.',
                'image_url' => '/cakekorean/Mom Vanilla Cake.jpg',
                'variants' => [
                    ['size' => '40x60', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $koreanCakeId,
                'name' => 'Korean Cake Ombre Choco',
                'description' => 'Korean Cake ombre coklat.',
                'image_url' => '/cakekorean/Ombre Choco. Cake.jpg',
                'variants' => [
                    ['size' => '40x60', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $koreanCakeId,
                'name' => 'Korean Cake Pink Seventen',
                'description' => 'Korean Cake pink seventeen manis.',
                'image_url' => '/cakekorean/Pink Seventen Cake.jpg',
                'variants' => [
                    ['size' => '40x60', 'price' => 325000, 'stock' => 10],
                ],
            ],

            // REGULARCAKE
            [
                'category_id' => $regularCakeId,
                'name' => 'Amazing 2 in 1 Cake',
                'description' => 'Amazing 2 in 1, Combination 2 delicious cake, chocolate millo and chocolate sensation in 1 cake.',
                'image_url' => '/cakereguler/2in1 Amazing Cake.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 285000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Anggel 2 in 1 Cake',
                'description' => 'Anggel 2 in 1, Combination 2 delicious cake, chocolate sensation and chocolate tiramisu in 1 cake.',
                'image_url' => '/cakereguler/2in1 Anggel Cake.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 285000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Best Choco 2 in 1 Cake',
                'description' => 'Best Choco. 2 in 1, Combination 2 delicious cake, nutella chocolate and chocolate sensation in 1 cake.',
                'image_url' => '/cakereguler/2in1 Best Choco Cake.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 285000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Delight 2 in 1 Cake',
                'description' => 'Delight 2 in 1, Combinasi 2 premium cake, romantic tiramisu and triple chocolate in 1 cake.',
                'image_url' => '/cakereguler/2in1 Delight Cake.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Family 2 in 1 Cake',
                'description' => 'Family 2 in 1 Combination 2 delicious cake, chocolate nutella andchocolate tiramisu in 1 cake.',
                'image_url' => '/cakereguler/2in1 Familly Cake.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 285000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Happy 2 in 1 Cake',
                'description' => 'Happy 2 in 1, Combination 2 delicious cake, nutella chocolate and milo chocolate in 1 cake.',
                'image_url' => '/cakereguler/2in1 Happy Cake.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 285000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Magnum 2 in 1 Cake',
                'description' => 'Magnum 2 in 1, Combinasi 2 premium cake, chocolate cheese and triple chocolate in 1 cake.',
                'image_url' => '/cakereguler/2in1 Magnum Cake.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Signature 2 in 1 Cake',
                'description' => 'Signature 2 in 1, Combinasi 2 premium cake, romantic tiramisu and chocolate cheese in 1 cake.',
                'image_url' => '/cakereguler/2in1 Signature Cake.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Cheese 2 in 1 Cake',
                'description' => 'Cheese 2 in 1, Combinasi 2 premium cake, red velvet cheese and chocolate cheese in 1 cake.',
                'image_url' => '/cakereguler/2in1Cheese Cake.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Yummy 2 in 1 Cake',
                'description' => 'Yumy 2 in 1, Combinasi 2 premium cake, red velvet cheese tiramisu in 1 cake.',
                'image_url' => '/cakereguler/2in1Yummy Cake.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => '4 in 1 Delicious Cake',
                'description' => 'Combinasi 4 delicious cake, and good taste milo, chocoolate tiramisu, chocolate sensation and Nutella cake in 1 cake.',
                'image_url' => '/cakereguler/4 in 1 Delicious Cake.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 285000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => '4 in 1 Premium Cake',
                'description' => 'Combinasi 4 premium cake, and good taste red velvet cheese, tripel chocolate chocolate cheese and tiramisu in 1 cake.',
                'image_url' => '/cakereguler/4 in 1 Premium Cake.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 285000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Black Forest Cake',
                'description' => 'Sponge with vanilla cream in each cherries covered with texture shaving of dark chocolate. “this cake mos popular in the world”',
                'image_url' => '/cakereguler/Black Forest.JPG',
                'variants' => [
                    ['size' => 'D.20cm', 'price' => 285000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Blueberry Cheese Cake',
                'description' => 'Baked cheese premium pe give the various of blueberry as the smooth of a baked cheese. “our all time recomend”',
                'image_url' => '/cakereguler/Blueberry Cheese.jpg',
                'variants' => [
                    ['size' => 'D.20cm', 'price' => 285000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Chocolate Tiramisu Cake',
                'description' => 'Chocolate tiramisu powder, combining with the coffee and choco. covered with choco. powder. “Sweeten Your Beautiful Day”',
                'image_url' => '/cakereguler/Choco Tiramisu.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 285000, 'stock' => 10],
                    ['size' => '30x20cm', 'price' => 427000, 'stock' => 10],
                    ['size' => '30x40cm', 'price' => 854000, 'stock' => 10],
                    ['size' => '40x60cm', 'price' => 1708000, 'stock' => 10],
                ],
            ],

            [ // masih belum jelas soalnya gada di pdf
                'category_id' => $regularCakeId,
                'name' => 'Choco. Bro. Cake',
                'description' => 'Combinations with chocolate and Brownies covered chocolate carving. "good taste and yummy"',
                'image_url' => '/cakereguler/Choco. Bro.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 285000, 'stock' => 10],
                    ['size' => '30x20cm', 'price' => 427000, 'stock' => 10],
                    ['size' => '30x40cm', 'price' => 854000, 'stock' => 10],
                    ['size' => '40x60cm', 'price' => 1708000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Chocolate Cheese Cake',
                'description' => 'Sits togetherwith a soft cream cheese and choco. mousse to makes this cake fully attractive. “share them with someone special”',
                'image_url' => '/cakereguler/Chocolate Cheese.JPG',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 325000, 'stock' => 10],
                    ['size' => '30x20cm', 'price' => 488000, 'stock' => 10],
                    ['size' => '30x40cm', 'price' => 976000, 'stock' => 10],
                    ['size' => '40x60cm', 'price' => 1952000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Nutela Cake',
                'description' => 'Mix with ice cream chocolate nutela and ground peanute in layer white sponge. Giving Your Love Ones!',
                'image_url' => '/cakereguler/Chocolate Nutela.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 285000, 'stock' => 10],
                    ['size' => '30x20cm', 'price' => 427000, 'stock' => 10],
                    ['size' => '30x40cm', 'price' => 854000, 'stock' => 10],
                    ['size' => '40x60cm', 'price' => 1708000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Chocolate Sensation Cake',
                'description' => 'Chocolate and more chocolate layers of moist choco. sponge with chocolate mousse, glazed with cover. “this cake special for you”',
                'image_url' => '/cakereguler/Chocolate Sensation.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 285000, 'stock' => 10],
                    ['size' => '30x20cm', 'price' => 427000, 'stock' => 10],
                    ['size' => '30x40cm', 'price' => 854000, 'stock' => 10],
                    ['size' => '40x60cm', 'price' => 1708000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Lapis Legit Plain',
                'description' => 'We have made this popular Indonesian traditional cake best quality Good for gift to client and family.',
                'image_url' => '/cakereguler/Lapis Legit Plain.JPG',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 355000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Lapis Legit Prune',
                'description' => 'We have made this popular Indonesian traditional cake best quality Good for gift to client and family.',
                'image_url' => '/cakereguler/Lapis Legit Prune.JPG',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 355000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Lapis Surabaya',
                'description' => 'We have made this popular Indonesian traditional cake best quality Good for gift to client and family.',
                'image_url' => '/cakereguler/Lapis Surabaya.JPG',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 355000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Mango Cake',
                'description' => 'A famous Vanila Sponge Cake with Fresh Mango Mousse covered with Mango Glaze.',
                'image_url' => '/cakereguler/Mango.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 285000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Milo Cake',
                'description' => 'Combination with chocolate mousse in layers and covered blend glass chocolate milo. “this cake special for you”',
                'image_url' => '/cakereguler/Milo Chocolate.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 285000, 'stock' => 10],
                    ['size' => '30x20cm', 'price' => 427000, 'stock' => 10],
                    ['size' => '30x40cm', 'price' => 854000, 'stock' => 10],
                    ['size' => '40x60cm', 'price' => 1708000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Mix Fruit Cheese Cake',
                'description' => 'Baked cheese premium, we give the various of fresh mix fruits as the smooth of a baked cheese. “this cake recomended loved”',
                'image_url' => '/cakereguler/Mix Fruit Cheese.jpg',
                'variants' => [
                    ['size' => 'D.20cm', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Mocha Cake',
                'description' => 'Combine with mocha mousse covered with Sponge Cake.',
                'image_url' => '/cakereguler/Mocha.jpg',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 285000, 'stock' => 10],
                    ['size' => '30x20cm', 'price' => 427000, 'stock' => 10],
                    ['size' => '30x40cm', 'price' => 854000, 'stock' => 10],
                    ['size' => '40x60cm', 'price' => 1708000, 'stock' => 10],
                ],
            ],

            [ // belum jelas
                'category_id' => $regularCakeId,
                'name' => 'Opera Cake',
                'description' => 'Are you a coffee lovers? Try this Opera Cake. This Cake Freshly baked with mixed Expresso Coffee and premium chocolate in every layer of Sponge Cake, covered with chocolate sparkle and chery on top',
                'image_url' => '/cakereguler/Opera.JPG',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 200000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Pinky Lady Cake',
                'description' => 'A Preety Presentation of Vanila Sponge Cake inside, combine with strawberry Mousse and White Chocolate Garnish.',
                'image_url' => '/cakereguler/Pink Lady.jpg',
                'variants' => [
                    ['size' => 'D.20cm', 'price' => 285000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Red Velvet Cheese Cake',
                'description' => 'Try our famous red velvet, sponge and premium cream cheese filling with a widespread tasty. “gift your love some one”',
                'image_url' => '/cakereguler/Red Velvet Cheese.JPG',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 325000, 'stock' => 10],
                    ['size' => '30x20cm', 'price' => 488000, 'stock' => 10],
                    ['size' => '30x40cm', 'price' => 976000, 'stock' => 10],
                    ['size' => '40x60cm', 'price' => 1952000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Romantic Tiramisu Cake',
                'description' => 'An authentic Italian premium cake layered vanilla sponge in coffee with chocolate powder. “our all time best seller”',
                'image_url' => '/cakereguler/Romantic Tiramisu.JPG',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 325000, 'stock' => 10],
                    ['size' => '30x20cm', 'price' => 488000, 'stock' => 10],
                    ['size' => '30x40cm', 'price' => 976000, 'stock' => 10],
                    ['size' => '40x60cm', 'price' => 1952000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Strawberry Cheese Cake',
                'description' => 'Baked cheese premium, we give the various of fresh strawberry fruits as the smooth of a baked cheese. now there is no reason to say “NO”',
                'image_url' => '/cakereguler/Strawberry Cheese.jpg',
                'variants' => [
                    ['size' => 'D.20cm', 'price' => 325000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Triple Chocolate Cake',
                'description' => 'Our Best Seller Chocolate premium Sponge Cake, with 3 layers White, Milk and Dark Chocolate. “this cake populer and recomended”',
                'image_url' => '/cakereguler/Triple Chocolate.JPG',
                'variants' => [
                    ['size' => '20x20cm', 'price' => 325000, 'stock' => 10],
                    ['size' => '30x20cm', 'price' => 488000, 'stock' => 10],
                    ['size' => '30x40cm', 'price' => 976000, 'stock' => 10],
                    ['size' => '40x60cm', 'price' => 1952000, 'stock' => 10],
                ],
            ],

            [
                'category_id' => $regularCakeId,
                'name' => 'Violet Cake',
                'description' => 'Kue Violet.',
                'image_url' => '/cakereguler/Violet.jpg',
                'variants' => [
                    ['size' => 'D.20cm', 'price' => 200000, 'stock' => 10],
                ],
            ],
            
            // WEEDINGCAKE
            [
                'category_id' => $weddingCakeId,
                'name' => 'Weeding & Anniversary 1',
                'description' => 'Kue wedding dan anniversary premium.',
                'image_url' => '/cakeweeding/Weeding & Anniversary 1.jpg',
                'variants' => [
                    ['size' => '20x20', 'price' => 550000, 'stock' => 5],
                    ['size' => '30x30', 'price' => 850000, 'stock' => 3],
                ],
            ],
            [
                'category_id' => $weddingCakeId,
                'name' => 'Weeding & Anniversary 2',
                'description' => 'Kue wedding dan anniversary premium.',
                'image_url' => '/cakeweeding/Weeding & Anniversary 2.jpg',
                'variants' => [
                    ['size' => '20x20', 'price' => 550000, 'stock' => 5],
                    ['size' => '30x30', 'price' => 850000, 'stock' => 3],
                ],
            ],
            [
                'category_id' => $weddingCakeId,
                'name' => 'Weeding & Anniversary 3',
                'description' => 'Kue wedding dan anniversary premium.',
                'image_url' => '/cakeweeding/Weeding & Anniversary 3.jpg',
                'variants' => [
                    ['size' => '20x20', 'price' => 550000, 'stock' => 5],
                    ['size' => '30x30', 'price' => 850000, 'stock' => 3],
                ],
            ],
            [
                'category_id' => $weddingCakeId,
                'name' => 'Weeding & Anniversary 4',
                'description' => 'Kue wedding dan anniversary premium.',
                'image_url' => '/cakeweeding/Weeding & Anniversary 4.jpg',
                'variants' => [
                    ['size' => '20x20', 'price' => 550000, 'stock' => 5],
                    ['size' => '30x30', 'price' => 850000, 'stock' => 3],
                ],
            ],
            [
                'category_id' => $weddingCakeId,
                'name' => 'Weeding & Anniversary 5',
                'description' => 'Kue wedding dan anniversary premium.',
                'image_url' => '/cakeweeding/Weeding & Anniversary 5.jpg',
                'variants' => [
                    ['size' => '20x20', 'price' => 550000, 'stock' => 5],
                    ['size' => '30x30', 'price' => 850000, 'stock' => 3],
                ],
            ],
            [
                'category_id' => $weddingCakeId,
                'name' => 'Weeding & Anniversary 6',
                'description' => 'Kue wedding dan anniversary premium.',
                'image_url' => '/cakeweeding/Weeding & Anniversary 6.jpg',
                'variants' => [
                    ['size' => '20x20', 'price' => 550000, 'stock' => 5],
                    ['size' => '30x30', 'price' => 850000, 'stock' => 3],
                ],
            ],
            [
                'category_id' => $weddingCakeId,
                'name' => 'Weeding & Anniversary 7',
                'description' => 'Kue wedding dan anniversary premium.',
                'image_url' => '/cakeweeding/Weeding & Anniversary 7.jpg',
                'variants' => [
                    ['size' => '20x20', 'price' => 550000, 'stock' => 5],
                    ['size' => '30x30', 'price' => 850000, 'stock' => 3],
                ],
            ],
            [
                'category_id' => $weddingCakeId,
                'name' => 'Weeding & Anniversary 8',
                'description' => 'Kue wedding dan anniversary premium.',
                'image_url' => '/cakeweeding/Weeding & Anniversary 8.jpg',
                'variants' => [
                    ['size' => '20x20', 'price' => 550000, 'stock' => 5],
                    ['size' => '30x30', 'price' => 850000, 'stock' => 3],
                ],
            ],
            [
                'category_id' => $weddingCakeId,
                'name' => 'Weeding & Anniversary 9',
                'description' => 'Kue wedding dan anniversary premium.',
                'image_url' => '/cakeweeding/Weeding & Anniversary 9.jpg',
                'variants' => [
                    ['size' => '20x20', 'price' => 550000, 'stock' => 5],
                    ['size' => '30x30', 'price' => 850000, 'stock' => 3],
                ],
            ],
            [
                'category_id' => $weddingCakeId,
                'name' => 'Weeding & Anniversary 10',
                'description' => 'Kue wedding dan anniversary premium.',
                'image_url' => '/cakeweeding/Weeding & Anniversary 10.jpg',
                'variants' => [
                    ['size' => '20x20', 'price' => 550000, 'stock' => 5],
                    ['size' => '30x30', 'price' => 850000, 'stock' => 3],
                ],
            ],

            // COOKIES
            [
                'category_id' => $cookiesId,
                'name' => 'Almond Cookie',
                'description' => 'Cookies renyah dengan taburan almond premium.',
                'image_url' => '/cookies/Almond Cookie.JPG',
                'variants' => [
                    ['size' => 'Toples 500gr', 'price' => 85000, 'stock' => 20],
                ],
            ],
            [
                'category_id' => $cookiesId,
                'name' => 'Chocolate Chips Cookie',
                'description' => 'Cookies klasik dengan butiran chocochips.',
                'image_url' => '/cookies/Chocolate Chips Cookie.JPG',
                'variants' => [
                    ['size' => 'Toples 500gr', 'price' => 75000, 'stock' => 20],
                ],
            ],
            [
                'category_id' => $cookiesId,
                'name' => 'Chocolate Mede Cookie',
                'description' => 'Perpaduan coklat dan kacang mete gurih.',
                'image_url' => '/cookies/Chocolate Mede Cookie.jpg',
                'variants' => [
                    ['size' => 'Toples 500gr', 'price' => 95000, 'stock' => 15],
                ],
            ],
            [
                'category_id' => $cookiesId,
                'name' => 'Chocolate MM Cookie',
                'description' => 'Cookies coklat dengan topping permen warna-warni.',
                'image_url' => '/cookies/Chocolate MM Cookie.jpg',
                'variants' => [
                    ['size' => 'Toples 500gr', 'price' => 80000, 'stock' => 20],
                ],
            ],
            [
                'category_id' => $cookiesId,
                'name' => 'Cornflakes Cookie',
                'description' => 'Cookies renyah dengan balutan cornflakes.',
                'image_url' => '/cookies/Cornflakes Cookie.JPG',
                'variants' => [
                    ['size' => 'Toples 500gr', 'price' => 70000, 'stock' => 20],
                ],
            ],
            [
                'category_id' => $cookiesId,
                'name' => 'Dark Choco Stick Cookie',
                'description' => 'Stick cookies dengan dark chocolate yang intens.',
                'image_url' => '/cookies/Dark Choco Stick Cookie.JPG',
                'variants' => [
                    ['size' => 'Toples 500gr', 'price' => 85000, 'stock' => 18],
                ],
            ],
            [
                'category_id' => $cookiesId,
                'name' => 'Green Velvet Cookie',
                'description' => 'Cookies green tea velvet yang unik.',
                'image_url' => '/cookies/Green Velvet Cookie.jpg',
                'variants' => [
                    ['size' => 'Toples 500gr', 'price' => 85000, 'stock' => 15],
                ],
            ],
            [
                'category_id' => $cookiesId,
                'name' => 'Kastangel Cookie',
                'description' => 'Kastangel keju yang gurih dan lumer.',
                'image_url' => '/cookies/Kastangel Cookie.jpg',
                'variants' => [
                    ['size' => 'Toples 500gr', 'price' => 110000, 'stock' => 25],
                ],
            ],
            [
                'category_id' => $cookiesId,
                'name' => 'Marble Cookie',
                'description' => 'Cookies dengan motif marmer yang cantik.',
                'image_url' => '/cookies/Marble Cookie.jpg',
                'variants' => [
                    ['size' => 'Toples 500gr', 'price' => 75000, 'stock' => 20],
                ],
            ],
            [
                'category_id' => $cookiesId,
                'name' => 'Nastar Cookie',
                'description' => 'Nastar klasik dengan selai nanas asli.',
                'image_url' => '/cookies/Nastar Cookie.jpg',
                'variants' => [
                    ['size' => 'Toples 500gr', 'price' => 105000, 'stock' => 30],
                ],
            ],
            [
                'category_id' => $cookiesId,
                'name' => 'Red Velvet Cookie',
                'description' => 'Cookies red velvet yang manis dan lembut.',
                'image_url' => '/cookies/Red Velvet Cookie.jpg',
                'variants' => [
                    ['size' => 'Toples 500gr', 'price' => 85000, 'stock' => 15],
                ],
            ],
            [
                'category_id' => $cookiesId,
                'name' => 'White Choco Stick Cookie',
                'description' => 'Stick cookies dengan lapisan coklat putih.',
                'image_url' => '/cookies/White Choco Stick Cookie.JPG',
                'variants' => [
                    ['size' => 'Toples 500gr', 'price' => 85000, 'stock' => 18],
                ],
            ],

            // FLORIST - BORD FLOWER
            [
                'category_id' => $bordFlowerId,
                'name' => 'Bunga Papan Ucapan 1',
                'description' => 'Bunga papan ucapan (Congratulations / Duka Cita) desain elegan.',
                'image_url' => '/florist/Bord of Flowers 1.jpg',
                'variants' => [
                    ['size' => '2m x 1.25m', 'price' => 500000, 'stock' => 10],
                    ['size' => '2m x 1.5m', 'price' => 750000, 'stock' => 5],
                ],
            ],
            [
                'category_id' => $bordFlowerId,
                'name' => 'Bunga Papan Ucapan 2',
                'description' => 'Bunga papan ucapan dengan rangkaian bunga segar.',
                'image_url' => '/florist/Bord of Flowers 2.jpg',
                'variants' => [
                    ['size' => '2m x 1.25m', 'price' => 500000, 'stock' => 10],
                ],
            ],
            [
                'category_id' => $bordFlowerId,
                'name' => 'Bunga Papan Ucapan 3',
                'description' => 'Bunga papan ucapan desain modern.',
                'image_url' => '/florist/Bord of Flowers 3.jpg',
                'variants' => [
                    ['size' => '2m x 1.25m', 'price' => 550000, 'stock' => 10],
                ],
            ],
            [
                'category_id' => $bordFlowerId,
                'name' => 'Bunga Papan Ucapan 4',
                'description' => 'Bunga papan ucapan full flower decoration.',
                'image_url' => '/florist/Bord of Flowers 4.jpg',
                'variants' => [
                    ['size' => '2m x 1.5m', 'price' => 800000, 'stock' => 5],
                ],
            ],
            [
                'category_id' => $bordFlowerId,
                'name' => 'Bunga Papan Ucapan 5',
                'description' => 'Bunga papan ucapan tema cerah.',
                'image_url' => '/florist/Bord of Flowers 5.jpg',
                'variants' => [
                    ['size' => '2m x 1.25m', 'price' => 500000, 'stock' => 10],
                ],
            ],
            [
                'category_id' => $bordFlowerId,
                'name' => 'Bunga Papan Ucapan 6',
                'description' => 'Bunga papan ucapan premium design.',
                'image_url' => '/florist/Bord of Flowers 6.jpg',
                'variants' => [
                    ['size' => '2m x 1.5m', 'price' => 850000, 'stock' => 5],
                ],
            ],
            [
                'category_id' => $bordFlowerId,
                'name' => 'Bunga Papan Ucapan 7',
                'description' => 'Bunga papan ucapan simple elegan.',
                'image_url' => '/florist/Bord of Flowers 7.jpg',
                'variants' => [
                    ['size' => '2m x 1.25m', 'price' => 450000, 'stock' => 10],
                ],
            ],
            [
                'category_id' => $bordFlowerId,
                'name' => 'Bunga Papan Ucapan 8',
                'description' => 'Bunga papan ucapan jumbo size.',
                'image_url' => '/florist/Bord of Flowers 8.jpg',
                'variants' => [
                    ['size' => '2m x 2m', 'price' => 1200000, 'stock' => 3],
                ],
            ],

            // FLORIST - HAND BUCKET
            [
                'category_id' => $handBucketId,
                'name' => 'Hand Bouquet Romantic 1',
                'description' => 'Buket bunga tangan mawar merah segar.',
                'image_url' => '/florist/Hand Buket Flower 1.jpg',
                'variants' => [
                    ['size' => 'Medium', 'price' => 250000, 'stock' => 15],
                    ['size' => 'Large', 'price' => 400000, 'stock' => 8],
                ],
            ],
            [
                'category_id' => $handBucketId,
                'name' => 'Hand Bouquet Soft Pink 2',
                'description' => 'Buket bunga nuansa pink lembut.',
                'image_url' => '/florist/Hand Buket Flower 2.jpg',
                'variants' => [
                    ['size' => 'Medium', 'price' => 275000, 'stock' => 15],
                ],
            ],
            [
                'category_id' => $handBucketId,
                'name' => 'Hand Bouquet Mix 3',
                'description' => 'Buket bunga campuran warna ceria.',
                'image_url' => '/florist/Hand Buket Flower 3.jpg',
                'variants' => [
                    ['size' => 'Medium', 'price' => 300000, 'stock' => 15],
                ],
            ],
            [
                'category_id' => $handBucketId,
                'name' => 'Hand Bouquet White 4',
                'description' => 'Buket bunga putih elegan (White Roses/Lily).',
                'image_url' => '/florist/Hand Buket Flower 4.jpg',
                'variants' => [
                    ['size' => 'Medium', 'price' => 350000, 'stock' => 10],
                ],
            ],
            [
                'category_id' => $handBucketId,
                'name' => 'Hand Bouquet Special 5',
                'description' => 'Buket bunga spesial hari kasih sayang.',
                'image_url' => '/florist/Hand Buket Flower 5.jpg',
                'variants' => [
                    ['size' => 'Large', 'price' => 500000, 'stock' => 5],
                ],
            ],

            // FLORIST - STANDING FLOWER
            [
                'category_id' => $standingFlowerId,
                'name' => 'Standing Flower Grand Opening 1',
                'description' => 'Standing flower mewah untuk grand opening.',
                'image_url' => '/florist/Standing Flower 1.jpg',
                'variants' => [
                    ['size' => 'Standard', 'price' => 750000, 'stock' => 5],
                ],
            ],
            [
                'category_id' => $standingFlowerId,
                'name' => 'Standing Flower Condolence 2',
                'description' => 'Standing flower duka cita nuansa putih.',
                'image_url' => '/florist/Standing Flower 2.jpg',
                'variants' => [
                    ['size' => 'Standard', 'price' => 700000, 'stock' => 5],
                ],
            ],
            [
                'category_id' => $standingFlowerId,
                'name' => 'Standing Flower Celebration 3',
                'description' => 'Standing flower warna-warni untuk perayaan.',
                'image_url' => '/florist/Standing Flower 3.jpg',
                'variants' => [
                    ['size' => 'Standard', 'price' => 850000, 'stock' => 5],
                ],
            ],
            [
                'category_id' => $standingFlowerId,
                'name' => 'Standing Flower Premium 4',
                'description' => 'Standing flower desain premium tinggi.',
                'image_url' => '/florist/Standing Flower 4.jpg',
                'variants' => [
                    ['size' => 'Premium', 'price' => 1200000, 'stock' => 3],
                ],
            ],

            // FLORIST - TABLE FLOWER
            [
                'category_id' => $tableFlowerId,
                'name' => 'Table Flower Centerpiece 1',
                'description' => 'Rangkaian bunga meja cantik dalam vas.',
                'image_url' => '/florist/Table Flower 1.jpg',
                'variants' => [
                    ['size' => 'Standard', 'price' => 350000, 'stock' => 10],
                ],
            ],
            [
                'category_id' => $tableFlowerId,
                'name' => 'Table Flower Classic 2',
                'description' => 'Bunga meja klasik cocok untuk ruang tamu.',
                'image_url' => '/florist/Table Flower 2.jpg',
                'variants' => [
                    ['size' => 'Standard', 'price' => 300000, 'stock' => 10],
                ],
            ],
            [
                'category_id' => $tableFlowerId,
                'name' => 'Table Flower Minimalist 3',
                'description' => 'Rangkaian bunga meja minimalis modern.',
                'image_url' => '/florist/Table Flower 3.jpg',
                'variants' => [
                    ['size' => 'Standard', 'price' => 250000, 'stock' => 12],
                ],
            ],
            [
                'category_id' => $tableFlowerId,
                'name' => 'Table Flower Elegant 4',
                'description' => 'Bunga meja nuansa elegan untuk kantor.',
                'image_url' => '/florist/Table Flower 4.jpg',
                'variants' => [
                    ['size' => 'Standard', 'price' => 400000, 'stock' => 8],
                ],
            ],
            [
                'category_id' => $tableFlowerId,
                'name' => 'Table Flower Fresh 5',
                'description' => 'Rangkaian bunga meja segar aromatik.',
                'image_url' => '/florist/Table Flower 5.jpg',
                'variants' => [
                    ['size' => 'Standard', 'price' => 350000, 'stock' => 10],
                ],
            ],
            [
                'category_id' => $tableFlowerId,
                'name' => 'Table Flower Luxury 6',
                'description' => 'Bunga meja rangkaian besar dan mewah.',
                'image_url' => '/florist/Table Flower 6.jpg',
                'variants' => [
                    ['size' => 'Large', 'price' => 600000, 'stock' => 5],
                ],
            ],
            
            // ==========================
            // HAMPERS IMLEK
            // ==========================
            [
                'category_id' => $hampersImlekId,
                'name' => 'Cake Imlek Chocolate',
                'description' => 'Kue coklat spesial dengan dekorasi tema Imlek.',
                'image_url' => '/hampersimlek/Cake IMLEK Chocolate.jpg',
                'variants' => [
                    ['size' => 'Standard', 'price' => 350000, 'stock' => 10],
                ],
            ],
            [
                'category_id' => $hampersImlekId,
                'name' => 'Cake Imlek Lapis Legit',
                'description' => 'Lapis legit premium khas Imlek.',
                'image_url' => '/hampersimlek/CAKE Imlek Lapis Legit.jpg',
                'variants' => [
                    ['size' => 'Whole', 'price' => 650000, 'stock' => 5],
                ],
            ],
            [
                'category_id' => $hampersImlekId,
                'name' => 'Hampers Imlek Hoki',
                'description' => 'Paket hampers Hoki berisi aneka kue kering.',
                'image_url' => '/hampersimlek/HAMPERS Imlek HOKI.JPG',
                'variants' => [
                    ['size' => 'Standard', 'price' => 500000, 'stock' => 8],
                ],
            ],
            [
                'category_id' => $hampersImlekId,
                'name' => 'Hampers Imlek Lunars',
                'description' => 'Bingkisan Lunars elegan untuk kerabat.',
                'image_url' => '/hampersimlek/Hampers Imlek LUNARS.JPG',
                'variants' => [
                    ['size' => 'Large', 'price' => 750000, 'stock' => 5],
                ],
            ],
            [
                'category_id' => $hampersImlekId,
                'name' => 'Hampers Imlek Ming',
                'description' => 'Paket Ming dengan kemasan merah klasik.',
                'image_url' => '/hampersimlek/Hampers Imlek MING.JPG',
                'variants' => [
                    ['size' => 'Medium', 'price' => 450000, 'stock' => 10],
                ],
            ],
            [
                'category_id' => $hampersImlekId,
                'name' => 'Hampers Imlek Rantang',
                'description' => 'Hampers unik dengan kemasan rantang susun.',
                'image_url' => '/hampersimlek/HAMPERS Imlek RANTANG.JPG',
                'variants' => [
                    ['size' => 'Set', 'price' => 550000, 'stock' => 6],
                ],
            ],
            [
                'category_id' => $hampersImlekId,
                'name' => 'Hampers Imlek Ribbon M',
                'description' => 'Hampers box pita ukuran Medium.',
                'image_url' => '/hampersimlek/Hampers Imlek RIBBON M.jpg',
                'variants' => [
                    ['size' => 'Medium', 'price' => 300000, 'stock' => 15],
                ],
            ],
            [
                'category_id' => $hampersImlekId,
                'name' => 'Hampers Imlek Ribbon S',
                'description' => 'Hampers box pita ukuran Small.',
                'image_url' => '/hampersimlek/Hampers Imlek RIBBON S.jpg',
                'variants' => [
                    ['size' => 'Small', 'price' => 200000, 'stock' => 20],
                ],
            ],
            [
                'category_id' => $hampersImlekId,
                'name' => 'Hampers Imlek Sincia',
                'description' => 'Paket Sincia lengkap untuk perayaan.',
                'image_url' => '/hampersimlek/HAMPERS Imlek SINCIA.JPG',
                'variants' => [
                    ['size' => 'Large', 'price' => 800000, 'stock' => 4],
                ],
            ],
            [
                'category_id' => $hampersImlekId,
                'name' => 'Hampers Imlek Spring',
                'description' => 'Nuansa musim semi dalam paket hampers.',
                'image_url' => '/hampersimlek/HAMPERS Imlek SPRING.JPG',
                'variants' => [
                    ['size' => 'Standard', 'price' => 400000, 'stock' => 10],
                ],
            ],
            [
                'category_id' => $hampersImlekId,
                'name' => 'Hampers Imlek Yang',
                'description' => 'Paket Yang berisi kombinasi kue favorit.',
                'image_url' => '/hampersimlek/Hampers Imlek YANG.JPG',
                'variants' => [
                    ['size' => 'Standard', 'price' => 350000, 'stock' => 12],
                ],
            ],
            [
                'category_id' => $hampersImlekId,
                'name' => 'Hampers Imlek Yin',
                'description' => 'Paket Yin, pasangan sempurna untuk Yang.',
                'image_url' => '/hampersimlek/Hampers Imlek YIN.JPG',
                'variants' => [
                    ['size' => 'Standard', 'price' => 350000, 'stock' => 12],
                ],
            ],

            // ==========================
            // HAMPERS KERAMIK
            // ==========================
            // Loop manual untuk varian TCH agar kode tidak terlalu panjang
            // Kamu bisa menyederhanakan ini jika punya pola harga tetap
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 1A',
                'description' => 'Set keramik pecah belah motif TCH 1A.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 1A.jpg',
                'variants' => [['size' => 'Set', 'price' => 750000, 'stock' => 3]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 1B',
                'description' => 'Set keramik pecah belah motif TCH 1B.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 1B.jpg',
                'variants' => [['size' => 'Set', 'price' => 750000, 'stock' => 3]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 1C',
                'description' => 'Set keramik pecah belah motif TCH 1C.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 1C.jpg',
                'variants' => [['size' => 'Set', 'price' => 750000, 'stock' => 3]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 2A',
                'description' => 'Set tea set keramik elegan TCH 2A.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 2A.jpg',
                'variants' => [['size' => 'Set', 'price' => 850000, 'stock' => 3]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 2B',
                'description' => 'Set tea set keramik elegan TCH 2B.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 2B.jpg',
                'variants' => [['size' => 'Set', 'price' => 850000, 'stock' => 3]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 3A',
                'description' => 'Set piring saji keramik TCH 3A.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 3A.jpg',
                'variants' => [['size' => 'Set', 'price' => 900000, 'stock' => 2]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 3B',
                'description' => 'Set piring saji keramik TCH 3B.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 3B.jpg',
                'variants' => [['size' => 'Set', 'price' => 900000, 'stock' => 2]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 41',
                'description' => 'Koleksi keramik eksklusif seri 41.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 41.jpg',
                'variants' => [['size' => 'Set', 'price' => 600000, 'stock' => 5]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 42',
                'description' => 'Koleksi keramik eksklusif seri 42.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 42.jpg',
                'variants' => [['size' => 'Set', 'price' => 600000, 'stock' => 5]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 51',
                'description' => 'Koleksi keramik eksklusif seri 51.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 51.jpg',
                'variants' => [['size' => 'Set', 'price' => 650000, 'stock' => 4]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 61',
                'description' => 'Koleksi keramik eksklusif seri 61.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 61.jpg',
                'variants' => [['size' => 'Set', 'price' => 700000, 'stock' => 4]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 71',
                'description' => 'Koleksi keramik eksklusif seri 71.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 71.jpg',
                'variants' => [['size' => 'Set', 'price' => 750000, 'stock' => 3]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 81',
                'description' => 'Koleksi keramik eksklusif seri 81.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 81.jpg',
                'variants' => [['size' => 'Set', 'price' => 800000, 'stock' => 3]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 91',
                'description' => 'Koleksi keramik eksklusif seri 91.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 91.jpg',
                'variants' => [['size' => 'Set', 'price' => 850000, 'stock' => 2]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 92',
                'description' => 'Koleksi keramik eksklusif seri 92.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 92.jpg',
                'variants' => [['size' => 'Set', 'price' => 850000, 'stock' => 2]],
            ],
            [
                'category_id' => $hampersKemarikId,
                'name' => 'Hampers Pecah Belah TCH 93',
                'description' => 'Koleksi keramik eksklusif seri 93.',
                'image_url' => '/hamperskeramik/Hampers Pecah Belah TCH 93.jpg',
                'variants' => [['size' => 'Set', 'price' => 850000, 'stock' => 2]],
            ],

            // ==========================
            // HAMPERS LEBARAN
            // ==========================
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Box Cookie Ramadhan Besek',
                'description' => 'Cookies Ramadhan dengan kemasan tradisional besek.',
                'image_url' => '/hampersleberan/Box Cookie Ramadhan BESEK.jpg',
                'variants' => [['size' => 'Standard', 'price' => 150000, 'stock' => 20]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Box Cookie Ramadhan Delight',
                'description' => 'Paket Delight berisi aneka kue kering lezat.',
                'image_url' => '/hampersleberan/Box Cookie Ramadhan DELIGHT.jpg',
                'variants' => [['size' => 'Standard', 'price' => 250000, 'stock' => 15]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Box Cookie Ramadhan Exclusive',
                'description' => 'Box Exclusive untuk hantaran spesial.',
                'image_url' => '/hampersleberan/Box Cookie Ramadhan EXLUSIVE.JPG',
                'variants' => [['size' => 'Large', 'price' => 450000, 'stock' => 10]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Box Cookie Ramadhan Gift Love',
                'description' => 'Bingkisan penuh cinta untuk keluarga.',
                'image_url' => '/hampersleberan/Box Cookie Ramadhan GIFT LOVE.jpg',
                'variants' => [['size' => 'Medium', 'price' => 300000, 'stock' => 12]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Box Cookie Ramadhan Golden',
                'description' => 'Nuansa emas yang mewah untuk Idul Fitri.',
                'image_url' => '/hampersleberan/Box Cookie Ramadhan GOLDEN.JPG',
                'variants' => [['size' => 'Large', 'price' => 500000, 'stock' => 8]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Box Cookie Ramadhan Green',
                'description' => 'Paket Green dengan tema ketupat.',
                'image_url' => '/hampersleberan/Box Cookie Ramadhan GREEN.JPG',
                'variants' => [['size' => 'Standard', 'price' => 275000, 'stock' => 15]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Box Cookie Ramadhan Premium',
                'description' => 'Koleksi cookies premium pilihan.',
                'image_url' => '/hampersleberan/Box Cookie Ramadhan PREMIUM.JPG',
                'variants' => [['size' => 'Premium', 'price' => 600000, 'stock' => 5]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Box Cookie Ramadhan Ribbon L',
                'description' => 'Box pita cantik ukuran Large.',
                'image_url' => '/hampersleberan/Box Cookie Ramadhan RIBBON L.JPG',
                'variants' => [['size' => 'Large', 'price' => 350000, 'stock' => 10]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Box Cookie Ramadhan Ribbon M',
                'description' => 'Box pita cantik ukuran Medium.',
                'image_url' => '/hampersleberan/Box Cookie Ramadhan RIBBON M.JPG',
                'variants' => [['size' => 'Medium', 'price' => 250000, 'stock' => 15]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Box Cookie Ramadhan Ribbon P',
                'description' => 'Box pita cantik edisi Panjang.',
                'image_url' => '/hampersleberan/Box Cookie Ramadhan RIBBON P.JPG',
                'variants' => [['size' => 'Long', 'price' => 300000, 'stock' => 12]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Box Cookie Ramadhan Ribbon S',
                'description' => 'Box pita cantik ukuran Small.',
                'image_url' => '/hampersleberan/Box Cookie Ramadhan RIBBON S.JPG',
                'variants' => [['size' => 'Small', 'price' => 175000, 'stock' => 20]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Cake Ramadhan Chocolate Printing',
                'description' => 'Cake coklat dengan printing motif masjid.',
                'image_url' => '/hampersleberan/Cake Ramadhan Chocolate Printing.jpg',
                'variants' => [['size' => 'Whole', 'price' => 400000, 'stock' => 5]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Cake Ramadhan Chocolate',
                'description' => 'Classic chocolate cake untuk berbuka.',
                'image_url' => '/hampersleberan/Cake Ramadhan Chocolate.jpg',
                'variants' => [['size' => 'Whole', 'price' => 350000, 'stock' => 8]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Hampers Cookie Ramadhan Grand',
                'description' => 'Hampers Grand super lengkap.',
                'image_url' => '/hampersleberan/HAMPERS Cookie Ramadhan GRAND.JPG',
                'variants' => [['size' => 'Extra Large', 'price' => 1200000, 'stock' => 2]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Hampers Cookie Ramadhan Large',
                'description' => 'Hampers ukuran besar untuk keluarga besar.',
                'image_url' => '/hampersleberan/HAMPERS Cookie Ramadhan Large.JPG',
                'variants' => [['size' => 'Large', 'price' => 750000, 'stock' => 5]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Hampers Cookie Ramadhan Medium',
                'description' => 'Hampers ukuran sedang yang pas.',
                'image_url' => '/hampersleberan/HAMPERS Cookie Ramadhan MEDIUM.JPG',
                'variants' => [['size' => 'Medium', 'price' => 500000, 'stock' => 10]],
            ],
            [
                'category_id' => $hampersLebaranId,
                'name' => 'Hampers Cookie Ramadhan Small',
                'description' => 'Hampers kecil tanda kasih.',
                'image_url' => '/hampersleberan/HAMPERS Cookie Ramadhan SMALL.JPG',
                'variants' => [['size' => 'Small', 'price' => 300000, 'stock' => 15]],
            ],

            // ==========================
            // HAMPERS NATAL
            // ==========================
            [
                'category_id' => $hampersNatalId,
                'name' => 'Box Natal Delight',
                'description' => 'Bingkisan Natal Delight penuh sukacita.',
                'image_url' => '/hampersnatal/BOX Delight.jpg',
                'variants' => [['size' => 'Standard', 'price' => 300000, 'stock' => 10]],
            ],
            [
                'category_id' => $hampersNatalId,
                'name' => 'Box Natal Giving',
                'description' => 'The season of Giving dalam satu box.',
                'image_url' => '/hampersnatal/BOX Giving.jpg',
                'variants' => [['size' => 'Medium', 'price' => 350000, 'stock' => 8]],
            ],
            [
                'category_id' => $hampersNatalId,
                'name' => 'Box Natal Gourmet',
                'description' => 'Pilihan gourmet untuk malam Natal.',
                'image_url' => '/hampersnatal/BOX Gourmet.jpg',
                'variants' => [['size' => 'Premium', 'price' => 550000, 'stock' => 5]],
            ],
            [
                'category_id' => $hampersNatalId,
                'name' => 'Box Natal Jolly',
                'description' => 'Have a Holly Jolly Christmas box.',
                'image_url' => '/hampersnatal/BOX Jolly.jpg',
                'variants' => [['size' => 'Standard', 'price' => 250000, 'stock' => 12]],
            ],
            [
                'category_id' => $hampersNatalId,
                'name' => 'Box Natal Ribbon L',
                'description' => 'Christmas Box Ribbon size Large.',
                'image_url' => '/hampersnatal/BOX RIBBON L.jpg',
                'variants' => [['size' => 'Large', 'price' => 400000, 'stock' => 8]],
            ],
            [
                'category_id' => $hampersNatalId,
                'name' => 'Box Natal Ribbon M',
                'description' => 'Christmas Box Ribbon size Medium.',
                'image_url' => '/hampersnatal/BOX RIBBON M.jpg',
                'variants' => [['size' => 'Medium', 'price' => 300000, 'stock' => 10]],
            ],
            [
                'category_id' => $hampersNatalId,
                'name' => 'Box Natal Signature',
                'description' => 'Signature hampers Natal terlaris.',
                'image_url' => '/hampersnatal/BOX Signature.jpg',
                'variants' => [['size' => 'Large', 'price' => 600000, 'stock' => 5]],
            ],
            [
                'category_id' => $hampersNatalId,
                'name' => 'Hampers Natal Exclusive',
                'description' => 'Hampers Natal mewah dan eksklusif.',
                'image_url' => '/hampersnatal/HAMPERS Exlusive.jpg',
                'variants' => [['size' => 'Luxury', 'price' => 900000, 'stock' => 3]],
            ],
            [
                'category_id' => $hampersNatalId,
                'name' => 'Hampers Natal Grand',
                'description' => 'Hampers Natal ukuran besar.',
                'image_url' => '/hampersnatal/HAMPERS Grand.jpg',
                'variants' => [['size' => 'Grand', 'price' => 800000, 'stock' => 4]],
            ],
            [
                'category_id' => $hampersNatalId,
                'name' => 'Hampers Natal Premium',
                'description' => 'Isi cookies dan coklat premium.',
                'image_url' => '/hampersnatal/HAMPERS Premium.jpg',
                'variants' => [['size' => 'Premium', 'price' => 700000, 'stock' => 5]],
            ],
            [
                'category_id' => $hampersNatalId,
                'name' => 'Hampers Natal Santa',
                'description' => 'Hampers lucu dengan tema Santa Claus.',
                'image_url' => '/hampersnatal/HAMPERS Santa.jpg',
                'variants' => [['size' => 'Standard', 'price' => 450000, 'stock' => 8]],
            ],

            // ==========================
            // BALON HAPPY BIRTHDAY
            // ==========================
            [
                'category_id' => $balonHBId,
                'name' => 'Balon Foil HBD Set 1',
                'description' => 'Set balon foil huruf Happy Birthday varian 1.',
                'image_url' => '/ornament/Balon HBD 1.jpg',
                'variants' => [
                    ['size' => 'Set', 'price' => 50000, 'stock' => 20],
                ],
            ],
            [
                'category_id' => $balonHBId,
                'name' => 'Balon Foil HBD Set 2',
                'description' => 'Set balon foil huruf Happy Birthday varian 2.',
                'image_url' => '/ornament/Balon HBD 2.jpg',
                'variants' => [
                    ['size' => 'Set', 'price' => 50000, 'stock' => 20],
                ],
            ],
            [
                'category_id' => $balonHBId,
                'name' => 'Balon Foil HBD Set 3',
                'description' => 'Set balon foil huruf Happy Birthday varian 3.',
                'image_url' => '/ornament/Balon HBD 3.jpg',
                'variants' => [
                    ['size' => 'Set', 'price' => 50000, 'stock' => 20],
                ],
            ],
            [
                'category_id' => $balonHBId,
                'name' => 'Balon Foil HBD Set 4',
                'description' => 'Set balon foil huruf Happy Birthday varian 4.',
                'image_url' => '/ornament/Balon HBD 4.jpg',
                'variants' => [
                    ['size' => 'Set', 'price' => 50000, 'stock' => 20],
                ],
            ],

            // ==========================
            // LILIN (ANGKA & KARAKTER)
            // ==========================
            [
                'category_id' => $lilinId,
                'name' => 'Lilin Angka 0',
                'description' => 'Lilin ulang tahun bentuk angka 0.',
                'image_url' => '/ornament/Lilin Angka 0.jpg',
                'variants' => [['size' => 'Pcs', 'price' => 5000, 'stock' => 50]],
            ],
            [
                'category_id' => $lilinId,
                'name' => 'Lilin Angka 1',
                'description' => 'Lilin ulang tahun bentuk angka 1.',
                'image_url' => '/ornament/Lilin Angka 1.jpg',
                'variants' => [['size' => 'Pcs', 'price' => 5000, 'stock' => 50]],
            ],
            [
                'category_id' => $lilinId,
                'name' => 'Lilin Angka 2',
                'description' => 'Lilin ulang tahun bentuk angka 2.',
                'image_url' => '/ornament/Lilin Angka 2.jpg',
                'variants' => [['size' => 'Pcs', 'price' => 5000, 'stock' => 50]],
            ],
            [
                'category_id' => $lilinId,
                'name' => 'Lilin Angka 3',
                'description' => 'Lilin ulang tahun bentuk angka 3.',
                'image_url' => '/ornament/Lilin Angka 3.jpg',
                'variants' => [['size' => 'Pcs', 'price' => 5000, 'stock' => 50]],
            ],
            [
                'category_id' => $lilinId,
                'name' => 'Lilin Angka 4',
                'description' => 'Lilin ulang tahun bentuk angka 4.',
                'image_url' => '/ornament/Lilin Angka 4.jpg',
                'variants' => [['size' => 'Pcs', 'price' => 5000, 'stock' => 50]],
            ],
            [
                'category_id' => $lilinId,
                'name' => 'Lilin Angka 5',
                'description' => 'Lilin ulang tahun bentuk angka 5.',
                'image_url' => '/ornament/Lilin Angka 5.jpg',
                'variants' => [['size' => 'Pcs', 'price' => 5000, 'stock' => 50]],
            ],
            [
                'category_id' => $lilinId,
                'name' => 'Lilin Angka 6',
                'description' => 'Lilin ulang tahun bentuk angka 6.',
                'image_url' => '/ornament/Lilin Angka 6.jpg',
                'variants' => [['size' => 'Pcs', 'price' => 5000, 'stock' => 50]],
            ],
            [
                'category_id' => $lilinId,
                'name' => 'Lilin Angka 7',
                'description' => 'Lilin ulang tahun bentuk angka 7.',
                'image_url' => '/ornament/Lilin Angka 7.jpg',
                'variants' => [['size' => 'Pcs', 'price' => 5000, 'stock' => 50]],
            ],
            [
                'category_id' => $lilinId,
                'name' => 'Lilin Angka 8',
                'description' => 'Lilin ulang tahun bentuk angka 8.',
                'image_url' => '/ornament/Lilin Angka 8.jpg',
                'variants' => [['size' => 'Pcs', 'price' => 5000, 'stock' => 50]],
            ],
            [
                'category_id' => $lilinId,
                'name' => 'Lilin Angka 9',
                'description' => 'Lilin ulang tahun bentuk angka 9.',
                'image_url' => '/ornament/Lilin Angka 9.jpg',
                'variants' => [['size' => 'Pcs', 'price' => 5000, 'stock' => 50]],
            ],
            [
                'category_id' => $lilinId,
                'name' => 'Lilin Birthday Set 1',
                'description' => 'Pack lilin ulang tahun motif standard.',
                'image_url' => '/ornament/Lilin Birthday1.jpg',
                'variants' => [['size' => 'Pack', 'price' => 15000, 'stock' => 30]],
            ],
            [
                'category_id' => $lilinId,
                'name' => 'Lilin Birthday Set 3',
                'description' => 'Pack lilin ulang tahun motif spiral.',
                'image_url' => '/ornament/Lilin Birthday3.jpg',
                'variants' => [['size' => 'Pack', 'price' => 15000, 'stock' => 30]],
            ],
            [
                'category_id' => $lilinId,
                'name' => 'Lilin HBD Boy',
                'description' => 'Lilin karakter HBD tema anak laki-laki (Biru).',
                'image_url' => '/ornament/Lilin HBD Boy.jpg',
                'variants' => [['size' => 'Pack', 'price' => 20000, 'stock' => 25]],
            ],
            [
                'category_id' => $lilinId,
                'name' => 'Lilin HBD Girl',
                'description' => 'Lilin karakter HBD tema anak perempuan (Pink).',
                'image_url' => '/ornament/Lilin HBD Girl.jpg',
                'variants' => [['size' => 'Pack', 'price' => 20000, 'stock' => 25]],
            ],
            [
                'category_id' => $lilinId,
                'name' => 'Lilin Magic',
                'description' => 'Lilin magic (sulit dipadamkan) untuk prank ultah.',
                'image_url' => '/ornament/Lilin Majic.jpg',
                'variants' => [['size' => 'Pack', 'price' => 10000, 'stock' => 40]],
            ],

            // ==========================
            // ORNAMENT (TOPPER KUE)
            // ==========================
            [
                'category_id' => $ornamentId,
                'name' => 'Topper Kue Cinderella',
                'description' => 'Hiasan kue karakter Cinderella cantik.',
                'image_url' => '/ornament/Ornament Cinderela.JPG',
                'variants' => [['size' => 'Set', 'price' => 75000, 'stock' => 10]],
            ],
            [
                'category_id' => $ornamentId,
                'name' => 'Topper Kue Donal & Mickey',
                'description' => 'Hiasan kue set karakter Donal Bebek & Mickey Mouse.',
                'image_url' => '/ornament/Ornament Donal & Micky.JPG',
                'variants' => [['size' => 'Set', 'price' => 85000, 'stock' => 8]],
            ],
            [
                'category_id' => $ornamentId,
                'name' => 'Topper Kue Doraemon & Friends',
                'description' => 'Hiasan kue lengkap Doraemon, Nobita, dan kawan-kawan.',
                'image_url' => '/ornament/Ornament Doraemon & Frend.JPG',
                'variants' => [['size' => 'Set', 'price' => 90000, 'stock' => 8]],
            ],
            [
                'category_id' => $ornamentId,
                'name' => 'Topper Kue Hulk',
                'description' => 'Action figure Hulk untuk hiasan kue.',
                'image_url' => '/ornament/Ornament Hulk.JPG',
                'variants' => [['size' => 'Pcs', 'price' => 60000, 'stock' => 12]],
            ],
            [
                'category_id' => $ornamentId,
                'name' => 'Topper Kue Mickey & Friends',
                'description' => 'Set hiasan kue Mickey Mouse dan teman-teman.',
                'image_url' => '/ornament/Ornament Micky & Fran.JPG',
                'variants' => [['size' => 'Set', 'price' => 85000, 'stock' => 8]],
            ],
            [
                'category_id' => $ornamentId,
                'name' => 'Topper Kue Spongebob',
                'description' => 'Hiasan kue dunia Bikini Bottom Spongebob.',
                'image_url' => '/ornament/Ornament Sponsbob.JPG',
                'variants' => [['size' => 'Set', 'price' => 80000, 'stock' => 10]],
            ],
            [
                'category_id' => $ornamentId,
                'name' => 'Topper Kue The Cars',
                'description' => 'Set mobil mainan The Cars untuk hiasan kue.',
                'image_url' => '/ornament/Ornament The Car.JPG',
                'variants' => [['size' => 'Set', 'price' => 85000, 'stock' => 10]],
            ],
            [
                'category_id' => $ornamentId,
                'name' => 'Topper Kue Transformer',
                'description' => 'Robot Transformer keren untuk hiasan kue.',
                'image_url' => '/ornament/Ornament Transformer.JPG',
                'variants' => [['size' => 'Pcs', 'price' => 70000, 'stock' => 12]],
            ],
        ];

        // Insert
        foreach ($products as $p) {
            $product = Product::create([
                'category_id' => $p['category_id'],
                'name'        => $p['name'],
                'description' => $p['description'],
                'image_url'   => $p['image_url'],
            ]);

            foreach ($p['variants'] as $variant) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'size'       => $variant['size'],
                    'price'      => $variant['price'],
                    'stock'      => $variant['stock'],
                ]);
            }
        }
    }
}
