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
        Schema::table('orders', function (Blueprint $table) {
            // Kolom untuk SakuRupiah
            $table->string('payment_url')->nullable()->after('total_price'); 
            $table->string('external_id')->nullable()->after('payment_url'); // ID dari SakuRupiah
            
            // Opsional: Kolom order_number string unik (jika belum ada/ingin format invoice)
            // Di migration lama kamu cuma ada 'id', kita butuh string unik buat Invoice
            $table->string('order_number')->unique()->after('id')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_url', 'external_id', 'order_number']);
        });
    }
};
