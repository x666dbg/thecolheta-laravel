<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
// ðŸ‘‡ 1. JANGAN LUPA IMPORT INI
use Illuminate\Database\Eloquent\Casts\Attribute; 

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image_url',
        'is_active',
    ];

    /**
     * ðŸ‘‡ 2. INI FITUR AJAIBNYA (ACCESSOR)
     * Otomatis ngerapihin URL gambar pas diambil dari DB.
     * Logic: Kalau di DB isinya 'foto.jpg', pas keluar jadi 'http://domain.com/storage/foto.jpg'
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                // 1. Kalo kosong, balikin null
                if (!$value) return null;

                // 2. 🔥 CEK APAKAH SUDAH URL LENGKAP? 🔥
                // Kalo depannya udah ada 'http' (mau http atau https),
                // balikin langsung apa adanya. JANGAN DIAPA-APAIN.
                if (str_starts_with($value, 'http')) {
                    return $value;
                }

                // 3. Kalo belum URL (masih path doang), baru kita proses
                // Bersihin path dari '/public/' atau '/storage/'
                $cleanPath = str_replace(['/public/', '/storage/'], '', $value);
                $cleanPath = ltrim($cleanPath, '/'); 

                // Bungkus pake asset()
                return asset('storage/' . $cleanPath);
            }
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
}