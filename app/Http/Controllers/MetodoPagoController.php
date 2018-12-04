<?php

namespace App\Http\Controllers;

use App\MetodoPago;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pago = MetodoPago::all();
        foreach ($pago as $key => $value) {
            $value->cuotas();
        }
        return $pago;
    }

     public function mostrarPagos()
    {
        $pagos = MetodoPago::all();
        
        $tipos_pagos = []; 
        
        foreach ($pagos as $key => $pago) {
            $tipos_pagos[] = $pago->tipo_pago;
        }
        return $tipos_pagos;
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
        $metodosPago = new MetodoPago($request->all());
        return ['resultado' => $metodosPago->save()];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MetodoPago  $metodoPago
     * @return \Illuminate\Http\Response
     */
    public function show(MetodoPago $metodosPago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MetodoPago  $metodoPago
     * @return \Illuminate\Http\Response
     */
    public function edit(MetodoPago $metodosago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MetodoPago  $metodoPago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MetodoPago $metodosPago)
    {
        return ['resultado' => $metodosPago->update($request->all())];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MetodoPago  $metodoPago
     * @return \Illuminate\Http\Response
     */
    public function destroy(MetodoPago $metodosPago)
    {
        return ['resultado' => $metodosPago->delete()];
    }
}
