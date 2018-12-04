<?php

namespace App\Http\Controllers;

use App\Ubicacion;
use App\Servicio;   
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ubicacion::all();
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

    public function ubicacionServicios(){
        $servicios = Servicio::where('estado', '=', 'activo')->orderBy('visitas','desc')->get();

        $ubicaciones = [];
        
        foreach ($servicios as $key => $servicio) {
            $ubicaciones[] = $servicio->ubicacion;
        }

        return $ubicaciones;
    }

    public function filtrarIngresos(Request $request){
        $servicios = Servicio::where([['ubicacion', '=', $request->ubicacion],
        ['fecha_publicacion_se', '>', $request->fecha_publicacion_se],
        ['fecha_finalizacion_se', '<=', $request->fecha_finalizacion_se]])->withCount("usuariosContratando")->get();
        
        return $servicios;
     
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Servicio $servicio)
    {
        $ubicacion = new Ubicacion($request->all());
        return ['resultado' => $servicio->Ubicacion()->save($ubicacion)];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ubicacion $ubicacion)
    {
        return ['resultado' => $ubicacion->update($request->all())];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ubicacion $ubicacion)
    {
        return ['resultado' => $ubicacion->delete()];
    }
}
