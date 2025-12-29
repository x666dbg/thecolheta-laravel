<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Kategori Utama
        $cakes = Category::create([
            'name' => 'Cakes',
            'description' => 'Berbagai pilihan kue lezat untuk setiap kesempatan.'
        ]);

        $cookies = Category::create([
            'name' => 'Cookies',
            'description' => 'Aneka kue kering dan cookies renyah.'
        ]);

        $florist = Category::create([
            'name' => 'Florist',
            'description' => 'Aneka rangkaian bunga.'
        ]);

        $hampers = Category::create([
            'name' => 'Hampers',
            'description' => 'Paket hadiah spesial untuk orang terkasih.'
        ]);

        $addon = Category::create([
            'name' => 'Add On',
            'description' => 'Tambahan opsional.'
        ]);


        // — SUBKATEGORI CAKES —
        $subCakes = [
            'Photo Printing Cake' => 'Kue printing foto.',
            'Character Cake'      => 'Kue tema karakter.',
            'Korean Cake'         => 'Kue ala Korea.',
            'Regular Cake'        => 'Kue biasa untuk segala acara.',
            'Wedding Cake'        => 'Kue pernikahan.'
        ];

        foreach ($subCakes as $name => $desc) {
            Category::create([
                'name' => $name,
                'description' => $desc,
                'parent_id' => $cakes->id
            ]);
        }


        // — SUBKATEGORI FLORIST —
        $subFlorist = [
            'Bord Flower'    => 'Karangan bunga papan.',
            'Hand Bucket'    => 'Bucket bunga tangan.',
            'Standing Flower' => 'Bunga standing.',
            'Table Flower'   => 'Rangkaian bunga meja.'
        ];

        foreach ($subFlorist as $name => $desc) {
            Category::create([
                'name' => $name,
                'description' => $desc,
                'parent_id' => $florist->id
            ]);
        }


        // — SUBKATEGORI HAMPERS —
        $subHampers = [
            'Hampers Imlek'   => 'Hampers edisi Imlek.',
            'Hampers Kemarik' => 'Hampers edisi spesial.',
            'Hampers Natal'   => 'Hampers natal.',
            'Hampers Lebaran' => 'Hampers lebaran.'
        ];

        foreach ($subHampers as $name => $desc) {
            Category::create([
                'name' => $name,
                'description' => $desc,
                'parent_id' => $hampers->id
            ]);
        }


        // — SUBKATEGORI ADD ON —
        $subAddon = [
            'Balon Happy Birthday' => 'Balon ulang tahun.',
            'Lilin'                => 'Lilin ulang tahun.',
            'Ornament'             => 'Ornamen dekorasi.'
        ];

        foreach ($subAddon as $name => $desc) {
            Category::create([
                'name' => $name,
                'description' => $desc,
                'parent_id' => $addon->id
            ]);
        }
    }
}
