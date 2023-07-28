<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client=Cliente::all();

        if($client->isEmpty()){
            return response()->json(['message' => "No hay Clientes Registrados"],201);    
        }
        return response()->json($client);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function getone(Request $request, $id)
     {
         $client=Cliente::find($id);

     if(!$client){
     return response()->json(['message'=>'Cliente no registrado']);
     }
         return response()->json($client);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'codigo' => 'required',
            'nombre' => 'required|max:45',
            'apellido' => 'required|max:45',
            'email' => 'required',
           
        ]);

        $client =Cliente::create($validateData);

        return response()->json([
            'messge'=>'cliente registrado exitosamente',
            'client'=>$client,

       ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData=$request->validate([
            'codigo' => 'required',
            'nombre' => 'required|max:45',
            'apellido' => 'required|max:45',
            'email' => 'required',
        ]);

        $client=Cliente::find($id);

        if (!$client){
             return response()->json(['message'=>'El cliente no esta registrado']);
        }
        $client->codigo=$validateData['codigo'];
        $client->nombre=$validateData['nombre'];
        $client->apellido=$validateData['apellido'];
        $client->email=$validateData['email'];

        $client->save();
        return response()->json([
            'message'=>'Cliente Actualizado exitosamente',
            'client'=>$client,
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente=Cliente::find($id);

        if(!$cliente){
            return response()->json(['message'=>'El cliente no esta registrado']);
        }
        $cliente->delete();
        return response()->json(['message'=>'Cliente Borrado Exitosamente']);
    }
}
