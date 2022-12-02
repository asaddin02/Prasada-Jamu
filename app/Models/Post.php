<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // fungsi untuk mengatur data post yang masuk ke database
    protected $table = 'posts';
    protected $guarded = [''];

    // fungsi untuk join dengan tabel produk
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
