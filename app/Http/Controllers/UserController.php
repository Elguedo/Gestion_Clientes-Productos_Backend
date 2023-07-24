<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //funcion para mostrar todo los usurios
    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }
//funcion pra mostrar un usurio por su id
    public function getone(Request $request, $id){

        $model=User::find($id);
        return response()->json($model);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //funcion para guardar un usuario
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        
        $user = User::create($validateData);

        return response()->json([
            'message'=> 'Usuario Creado Exitosamente',
            'user' => $user,
        ],201);
    }

//funcion paara uatenticar a un usuario
    public function login(Request $request){
        $creadencial=$request->validate([
            'email'=> 'required|email',
            'password'=>'required',
        ]);

        if (Auth::attempt($creadencial)){
            $user=Auth::user();
            $tokem =$user->createToken('authToken')->accessToken;
            return response()->jsom([
                'accessToken'=> $token,
                'token_type'=> 'Bearer',
                'expire_at'=> now()->addHours(1),

            ]);

        }
        return response()->json(['error' => 'Unauthorized'],401);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //funcion pra editar un usuario 
    public function update(Request $request, $id)
    {
        $validateData=$request->validate([
            'name'=> 'required|max:255',
            'email'=>'required',
            'password'=>'required:8',

        ]);
        $model=User::find($id);

        if (!$model){
            return response()->json(['message' => 'Persona no encontrada'],400);
        }

        $model->name=$validateData['name'];
        $model->email =$validateData['email'];
        $model->password = bcrypt($validateData['password']);

        $model->save();
        return response()->json([
            'message'=> 'Usuario Actualizado Exitosamente',
            'user' => $model,
        ],201);
            
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//funcion para borrar un usuario
 public function destroy($id){

    $user=User::find($id);

    if(!$user){
        return response()->json(['message' => 'El usurio no eta registrado']);
    }

    $user->delete();

    return  response()->json(['message'=> 'El Usuario a sido borrado exitosament'], 200);
 }
}
