<?php

namespace App\Http\Controllers;

use App\User;
use App\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Servicio::orderBy('visitas','desc')->get();   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function serviciosActivos(){
        return Servicio::where('estado', '=', 'activo')->orderBy('visitas','desc')->get();
        
    }
    
    public function create()
    {
        //
    }

    public function serviciosContratados()
    {   
        $user = Auth::user();
        $servicios = $user->ServiciosContratados;

        foreach($servicios as $servicio){
            $servicio->pivot;
        }

        return $servicios;
        
        /*
        return $servicios  = DB::table('servicio_user')
        ->join('users', 'servicio_user.user_id', '=', 'users.id')
        ->select(
            'servicio_user.fecha_contratacion',
            'servicio_user.fecha_fin_contratacion',
            'servicio_user.descuento_tipo_cliente',
            'servicio_user.tipo_pago',
            'servicio_user.numero_tarjeta',
            'servicio_user.numero_cuota',
            'servicio_user.valor_cuota')->get();
*/
    }

    public function serviciosUsuario()
    {
        $user = Auth::user();
        return $user->Servicios;
    }

    public function guardarContrato(Request $request, Servicio $servicio, User $usuario){
        $usuario->ServiciosContratados()->save($servicio,
            ['fecha_contratacion' => $request->fecha_contratacion,
            'fecha_fin_contratacion' => $request->fecha_fin_contratacion,
            'descuento_tipo_cliente' => $request->descuento_tipo_cliente,
            'tipo_pago' => $request->tipo_pago,
            'numero_tarjeta' => $request->numero_tarjeta,
            'numero_cuota' => $request->numero_cuota,
            'valor_cuota' => $request->valor_cuota,
            ]
        );
    }

     public function actualizarContrato(Request $request, Servicio $servicio, User $usuario)
    {
        return ['resultado' => $usuario->serviciosContratados()->updateExistingPivot($servicio, $request->all())];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $servicio = new Servicio($request->all());
        return ['resultado' => $user->Servicios()->save($servicio)];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        return Servicio::find($servicio);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicio)
    {
        return ['resultado' => $servicio->update($request->all())];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicio)
    {
        return ['resultado' => $servicio->delete()];
    }
}
