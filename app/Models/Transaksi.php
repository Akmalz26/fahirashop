<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_produk',
        'id_pelanggan',
        'id_kasir',
        'tgl',
        'jumlah'
    ];

    public function Produk()
    {
        return $this->belongsTo(produk::class, 'id_produk');
    }
    
    public function pelanggan()
    {
        return $this->belongsTo(pelanggan::class, 'id_pelanggan');
    }
    
    public function Kasir()
    {
        return $this->belongsTo(Kasir::class, 'id_kasir');
    }
}
