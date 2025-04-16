<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    // Tentukan tabel, jika nama tabel tidak sama dengan model
    protected $table = 'dashboard';

    // Kolom yang boleh diisi
    protected $fillable = ['title', 'description'];
}
