<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    // fungsi untuk mengatur data produk yang masuk ke database
    protected $table = 'produks';
    protected $guarded = [''];

    // fungsi untuk join dengan tabel category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
