<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $fillable = [
        'cliente_id', 'session_id', 'token', 'monto', 'estado', 'created_at'
    ];

    public $timestamps = false;
}

