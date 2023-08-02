<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $guarded = [];

    use HasFactory;


    public function penjualan_detail()
    {
        return $this->hasMany(PenjualanDetail::class, 'id_produk');
    }
}
