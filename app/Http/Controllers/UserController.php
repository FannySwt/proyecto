<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Perfil_Secretaria;
use App\Perfil_Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();


        foreach($usuarios as $usuario){
            if($usuario->tipo_usuario == 'cliente'){
                $usuario->Perfil_Cliente;
            }
            else if($usuario->tipo_usuario == 'secretaria'){
                $usuario->Perfil_Secretaria;
            }
        }

        return $usuarios;
        /*
                $clientes = Perfil_Cliente::all();
        $secretarias = Perfil_Secretaria::all();

        $usuario = [];
        foreach($secretarias as $secretaria){
            $secretaria->User;
            $usuarios[] = $secretaria;
        }

        return $usuarios;
*/

        /*$clientes  = DB::table('users')
        ->join('perfil__clientes', 'users.id', '=', 'perfil__clientes.user_id')
        ->select(
            'users.rut_usuario',
            'users.nombre_usuario',
            'users.email',
            'users.password',
            'users.alias',
            'users.fecha_nac',
            'users.domicilio_usuario',
            'users.telefono',
            'users.tipo_usuario',
            'perfil__clientes.reputacion_cliente',
            'perfil__clientes.estado_cliente',
            'perfil__clientes.tipo_cliente')->get();
        
        $secretarias = DB::table('users')
        ->join('perfil__secretarias', 'users.id', '=', 'perfil__secretarias.user_id')
        ->select(
            'users.rut_usuario',
            'users.nombre_usuario',
            'users.email',
            'users.password',
            'users.alias',
            'users.fecha_nac',
            'users.domicilio_usuario',
            'users.telefono',
            'users.tipo_usuario',
            'perfil__secretarias.fecha_contratacion')->get();

        $usuarios = ['clientes' =>$clientes, 'secretarias' => $secretarias];

        return $clientes;*/
    }

    public function user_login(){
        return $user = Auth::user();
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

         public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        return json_encode(Auth::attempt($credentials));
            // Authentication passed...
    
    }

     public function logout(Request $request)
    {
        return Auth::logout();
            // Authentication passed...
    
    }
}
