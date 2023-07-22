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
    public function index()
    {
        $user = User::all();
        return response()->json($user);
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
            'name'=> 'required|max:255',
            'email'=>'requerided|unique:users|email|max:255',
            'password'=>'requerided:8',

        ]);
        $user = User::create($validateData);

        return response()->json([
            'message'=> 'Usuario Creado Exitosamente',
            'user' => $user,
        ],201);
    }

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
