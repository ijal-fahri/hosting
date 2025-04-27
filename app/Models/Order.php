<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda
    protected $table = 'orders';

    // Tentukan atribut yang boleh diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'origin',
        'destination',
        'courier',
        'service',
        'weight',
        'total_price',
        'masukan',
        'alamat',
        'payment_photo',
        'status'
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'weight' => 'integer',
    ];

    // Relasi ke OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}