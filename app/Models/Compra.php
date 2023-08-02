<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = ['cliente_id', 'producto_id', 'cantidad', 'total_venta'];

    public function productos()
{
    return $this->belongsToMany(Producto::class, 'compra_producto', 'compra_id', 'producto_id')
                ->withPivot('cantidad', 'total_venta');
}

    // Relación con la tabla "clientes"
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Relación con la tabla "productos"
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function calcularTotal()
    {
        return $this->cantidad * $this->producto->precio;
    }
}
