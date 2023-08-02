<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function produk1()
    {
        return $this->hasOne(Produk::class, 'id_produk', 'id_produk1');
    }

    public function produk2()
    {
        return $this->hasOne(Produk::class, 'id_produk', 'id_produk2');
    }
}
