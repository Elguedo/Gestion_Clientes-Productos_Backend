<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getall()
    {
        $ModelCompra=Compra::all();
        if($ModelCompra->isEmpty()){
          return response()->json(['message' => "No hay hay compras registradas"],201); 
        }
        return response()->json($ModelCompra);
    }

    public function getone(Request $request, $id){

        $ModelCompra=Compra::find($id);

        if(!$ModelCompra){
            return response()->json(['message' => 'El la compra no se encuentra registrada']);
        }
        return response()->json($ModelCompra);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);
    
        $cliente_id = $request->cliente_id;
        $productos = $request->productos;
        $total_venta = 0;
    
        // Calcular el total de la compra recorriendo los productos
        foreach ($productos as $producto) {
            $producto_id = $producto['producto_id'];
            $cantidad = $producto['cantidad'];
    
            $producto_Model = Producto::find($producto_id);
    
            if (!$producto_Model) {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }
    
            $subTotal = $producto_Model->precio * $cantidad;
            $total_venta += $subTotal;
    
            // Crear registro en la tabla compras por cada producto
            Compra::create([
                'cliente_id' => $cliente_id,
                'producto_id' => $producto_id,
                'cantidad' => $cantidad,
                'total_venta' => $subTotal,
            ]);
        }
    
        // Crear registro de la compra con el total
        Compra::create([
            'cliente_id' => $cliente_id,
            'total_venta' => $total_venta,
        ]);
    
        return response()->json(['message' => 'Compra realizada con éxito']);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        //
    }
}
