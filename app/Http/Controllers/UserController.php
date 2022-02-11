<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Direccion;
use App\Models\DireccionFacturaccion;
use App\Models\Review;
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
        $user = auth()->user()->id;
        $direcciones = Direccion::join('municipios', 'direcciones.id_municipio', '=', 'municipios.id')
        ->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id')->where('id_user', $user)
        ->select('direcciones.*', 'departamentos.nombre as departamento', 'municipios.nombre as municipio', 'municipios.id_departamento')->get();
        $facturaciones = DireccionFacturaccion::join('municipios', 'direcciones_facturaciones.id_municipio', '=', 'municipios.id')
        ->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id')->where('id_user', $user)
        ->select('direcciones_facturaciones.*', 'departamentos.nombre as departamento', 'municipios.nombre as municipio', 'municipios.id_departamento')->get();
        $valoraciones = Review::join('productos', 'opiniones.id_producto', '=', 'productos.id')->where('id_usuario', $user)->select('opiniones.*', 'productos.nombre')->get();
        return view('frontend.layouts.profile')->with('direcciones', $direcciones)->with('facturaciones', $facturaciones)->with('valoraciones', $valoraciones);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
