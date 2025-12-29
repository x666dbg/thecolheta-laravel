<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ini adalah tabel BARU Anda untuk menyimpan harga, stok, dan ukuran
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();

            // Foreign key ke tabel products
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Varian size (contoh: 20x20, 30x40)
            $table->string('size')->nullable();

            // Harga per varian
            $table->decimal('price', 10, 2);

            // Stok per varian
            $table->integer('stock')->default(0);

            $table->timestamps();

            // Index untuk pencarian cepat
            $table->index(['product_id', 'size']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
