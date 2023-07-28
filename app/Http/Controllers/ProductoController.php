<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //funcion para mostrar todos los productos 
    public function index(Request $request)
    {
        //Obtenemos todos los productos de la base de datos y retornamos un json
            $product=Producto::all();

        if($product->isEmpty()){
                return response()->json(['message' => "No hay productos registrados"],201);    
            }
            return response()->json($product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //funcion para mostrar un productos por su id 
    public function show(Request $request,$id)
    {
        $product=Producto::find($id);

        if(!$product){
            return response()->json(['message' => 'Producto no registrado'],400);

        }
        return response()->json($product);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //funcion parar guardar o registrar un producto
    public function store(Request $request)
    {
        $ValidateData = $request->validate([
            'codigo' => 'required',
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'precio' => 'required'
        ]);

        $product = Producto::create($ValidateData);

        return response()->json([
            'message'=> 'Producto Creado Exitosamente',
            'product' => $product,
        ],201);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    //funcion que permite editar un producto
    public function update(Request $request, $id)
    {
        $ValidateData=$request->validate([
            'codigo' => 'required',
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'precio' => 'required'
        ]);

        $model=Producto::find($id);

        if(!$model){
            return response()->json(['message'=>'No se encontro el producto'],401);
        }

        $model->codigo=$ValidateData['codigo'];
        $model->nombre=$ValidateData['nombre'];
        $model->descripcion=$ValidateData['descripcion'];
        $model->precio=$ValidateData['precio'];

        $model->save();
        return response()->json([
            'message'=> 'Producto Actualizado Exitosamente',
            'Product' => $model,
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    //funcion que permite eliminar un producto
    public function destroy($id)
    {
        //Buscar Producto por ID y eliminarlo de la BD
        try{
            $product = Producto::where('id',$id)->firstOrFail();
            $product -> delete();
            return Response(["Mensaje" => "el producto Se ha eliminado correctamente"], 200);
            }catch(\Exception $e){
                return Response(["Error al Eliminar", $e], 401);

        }
}
}