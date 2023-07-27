<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'codigo',
        'nombre',
        'apellido',
        'email',

    ];
}
