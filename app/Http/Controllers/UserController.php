<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Perfil_Secretaria;
use App\Perfil_Cliente;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new User($request->all());
        $usuario->save();

        if($usuario->tipo_usuario == 'admin'){
            return ['resultado' => true ];
        }
        else if($usuario->tipo_usuario == 'secretaria'){
            $secretaria = new Perfil_Secretaria($request->all());
            return ['resultado' => $usuario->Perfil_Secretaria()->save($secretaria)];
        }
        else{
            $cliente = new Perfil_Cliente($request->all());
            return ['resultado' => $usuario->Perfil_cliente()->save($cliente)];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $usuario->update($request->all());
        
        if($usuario->tipo_usuario == 'admin'){
            return ['resultado' => true ];
        }
        else if($usuario->tipo_usuario == 'secretaria'){
            $secretaria = $usuario->Perfil_Secretaria;
            return ['resultado' => $secretaria->update($request->all())];
        }
        else{
            $cliente = $usuario->Perfil_Cliente;
            return ['resultado' => $cliente->update($request->all())];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        return ['resultado' => $usuario->delete()];
    }

    public function hash(Request $request){
        return Hash::make($request->password);
    }
}
