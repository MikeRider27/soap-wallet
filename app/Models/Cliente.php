<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
        'documento', 'nombre', 'email', 'celular', 'saldo'
    ];

    public $timestamps = false; // si no usás created_at y updated_at
}

