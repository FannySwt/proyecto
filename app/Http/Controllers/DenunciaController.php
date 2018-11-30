<?php

namespace App\Http\Controllers;

use App\Denuncia;
use App\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DenunciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Denuncia::all();
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

    public function comentariosDenuncia(Servicio $servicio){
        return Denuncia::find($servicio);
    }

    public function serviciosDenunciados(){
        return $servicios = Servicio::where('denunciado', '=', 'si')->get();
                    

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $denuncia = new Denuncia($request->all());
        return ['resultado' => $servicio->Denuncia()->save($denuncia)];
    }

    public function denunciaServicio(Request $request, Servicio $servicio){
        $denuncia = new Denuncia($request->all());
        return ['resultado' => $servicio->Denuncia()->save($denuncia)];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Denuncia  $denuncia
     * @return \Illuminate\Http\Response
     */
    public function show(Denuncia $denuncia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Denuncia  $denuncia
     * @return \Illuminate\Http\Response
     */
    public function edit(Denuncia $denuncia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Denuncia  $denuncia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Denuncia $denuncia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Denuncia  $denuncia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Denuncia $denuncia)
    {
        return ['resultado' => $denuncia->delete()];
    }
}
