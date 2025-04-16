<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Nama tabel dalam database
    protected $table = 'products';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'name',
        'description',
        'code',
        'price',
        'stock',
        'photo',
        'status',
        'diskon',
        'harga_diskon', 
    ];

    // Tipe data cast untuk atribut tertentu
    protected $casts = [
        'price' => 'decimal:2',
        'status' => 'string',
    ];
}
