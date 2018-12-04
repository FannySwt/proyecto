<?php

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app');
});

Route::get('/home', function () {
    return view('app');
});
Route::get('/home/users', function () {
    return view('app');
});
Route::get('/home/servicios', function () {
    return view('app');
});
Route::get('/login', function () {
    return view('app');
});
Route::get('/admin', function () {
    return view('app');
});
Route::get('/admin/servicios', function () {
    return view('app');
});
Route::get('/admin/verServicios', function () {
    return view('app');
});
Route::get('/admin/users', function () {
    return view('app');
});
Route::get('/admin/perfil', function () {
    return view('app');
});
Route::get('/admin/categorias', function () {
    return view('app');
});
Route::get('/admin/metodosPagos', function () {
    return view('app');
});
Route::get('/admin/serviciosContratados', function () {
    return view('app');
});
Route::get('/admin/filtrar', function () {
    return view('app');
});
Route::get('/admin/filtrarServicios', function () {
    return view('app');
});
Route::get('/secretaria', function () {
    return view('app');
});
Route::get('/secretaria/validar', function () {
    return view('app');
});
Route::get('/secretaria/servicios', function () {
    return view('app');
});
Route::get('/secretaria/contratar', function () {
    return view('app');
});
Route::get('/secretaria/users', function () {
    return view('app');
});
Route::get('/secretaria/serviciosContratados', function () {
    return view('app');
});
Route::get('/secretaria/serviciosDenunciados', function () {
    return view('app');
});
Route::get('/secretaria/perfil', function () {
    return view('app');
});
Route::get('/secretaria/filtrar', function () {
    return view('app');
});
Route::get('/secretaria/filtrarServicios', function () {
    return view('app');
});
Route::get('/cliente', function () {
    return view('app');
});
Route::get('/cliente/servicios', function () {
    return view('app');
});
Route::get('/cliente/verServicios', function () {
    return view('app');
});
Route::get('/cliente/contratar/{servicio}', function () {
    return view('app');
});
Route::get('/cliente/serviciosContratados', function () {
    return view('app');
});
Route::get('/cliente/perfil', function () {
    return view('app');
});
Route::get('/cliente/filtrar', function () {
    return view('app');
});
Route::get('/cliente/filtrarServicios', function () {
    return view('app');
});



Route::resource('usuarios','UserController', ['except'=>['edit','create']]);
Route::resource('servicios','ServicioController', ['except'=>['edit','create']]);
Route::resource('ubicaciones','UbicacionController', ['except'=>['show','edit','create']]);
Route::resource('categorias','CategoriaController', ['except'=>['show','edit','create']]);
Route::resource('metodosPagos','MetodoPagoController', ['except'=>['show','edit','create']]);
Route::resource('denuncias','DenunciaController', ['except'=>['show','edit','create']]);

Route::post('/denunciaServicio/{servicio}','DenunciaController@denunciaServicio');
Route::get('/serviciosUsuario','ServicioController@serviciosUsuario');
Route::post('/serviciosUsuario/{servicio}/{usuario}','ServicioController@guardarContrato');
Route::put('/serviciosUsuario/{servicio}/{usuario}','ServicioController@actualizarContrato');
Route::get('/serviciosContratados','ServicioController@serviciosContratados');
Route::get('/serviciosActivos','ServicioController@serviciosActivos');
Route::get('/serviciosDenunciados','DenunciaController@serviciosDenunciados');
Route::get('/comentariosDenuncia/{servicio}','DenunciaController@comentariosDenuncia');
Route::get('/serviciosCreadosPorUsuario/{usuario}','ServicioController@serviciosCreadosPorUsuario');
Route::get('/ubicacionServicios','UbicacionController@ubicacionServicios');
Route::post('/filtrarIngresos','UbicacionController@filtrarIngresos');
Route::get('/mostrarCategorias','CategoriaController@mostrarCategorias');
Route::get('/mostrarPagos','MetodoPagoController@mostrarPagos');
Route::post('/filtrarServicios','ServicioController@filtrarServicios');

Route::post('/hash','UserController@hash');

Route::post('/login','UserController@login');
Route::post('/logout','UserController@logout');

Route::post('/auth',function () {
    if (Auth::check()) {
            return json_encode(Auth::user());
            
        }
        return json_encode("");
});


Route::get('/home', 'HomeController@index')->name('home');
