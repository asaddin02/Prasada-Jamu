<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // fungsi untuk mengatur data category yang masuk ke database
    protected $table = 'categories';
    protected $guarded = [''];

    // fungsi untuk join dengan tabel produk
    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
