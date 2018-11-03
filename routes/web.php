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
Route::get('/login', function () {
    return view('app');
});
Route::get('/admin', function () {
    return view('app');
});
Route::get('/admin/users', function () {
    return view('app');
});
Route::get('/admin/metodosPagos', function () {
    return view('app');
});
Route::get('/secretaria', function () {
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
Route::get('/cliente/contratar', function () {
    return view('app');
});



Route::resource('usuarios','UserController', ['except'=>['show','edit','create']]);
Route::resource('servicios','ServicioController', ['except'=>['show','edit','create']]);
Route::resource('ubicaciones','UbicacionController', ['except'=>['show','edit','create']]);
Route::resource('categorias','CategoriaController', ['except'=>['show','edit','create']]);
Route::resource('metodosPagos','MetodoPagoController', ['except'=>['show','edit','create']]);

Route::get('/serviciosUsuario','ServicioController@serviciosUsuario');

Route::post('/hash','UserController@hash');
Route::post('/auth',function () {
    if (Auth::guard()->check()) {
            return Auth::user();
        }
        return null;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
