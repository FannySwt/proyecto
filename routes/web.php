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

Route::group(['prefix' => '/', 'middleware'=>['home']], function () {
    Route::get('', function () {
        return view('app');
    });

    Route::get('home', function () {
        return view('app');
    });
    Route::get('home/users', function () {
        return view('app');
    });
    Route::get('home/servicios', function () {
        return view('app');
    });
});

    Route::get('login', function () {
        return view('app');
    });


Route::group(['prefix' => 'admin', 'middleware'=>['usuarioAdmin']], function () {

    Route::get('/', function () {
        return view('app');
    });
    Route::get('/servicios', function () {
        return view('app');
    });
    Route::get('/verServicios', function () {
        return view('app');
    });
    Route::get('/users', function () {
        return view('app');
    });
    Route::get('/perfil', function () {
        return view('app');
    });
    Route::get('/categorias', function () {
        return view('app');
    });
    Route::get('/metodosPagos', function () {
        return view('app');
    });
    Route::get('/serviciosContratados', function () {
        return view('app');
    });
    Route::get('/filtrar', function () {
        return view('app');
    });
    Route::get('/filtrarServicios', function () {
        return view('app');
    });
});
    
Route::group(['prefix' => 'secretaria', 'middleware'=>['usuarioSecretaria']], function () {
    Route::get('/', function () {
        return view('app');
    });
    Route::get('/validar', function () {
        return view('app');
    });
    Route::get('/servicios', function () {
        return view('app');
    });
    Route::get('/contratar', function () {
        return view('app');
    });
    Route::get('/users', function () {
        return view('app');
    });
    Route::get('/serviciosContratados', function () {
        return view('app');
    });
    Route::get('/serviciosDenunciados', function () {
        return view('app');
    });
    Route::get('/perfil', function () {
        return view('app');
    });
    Route::get('/filtrar', function () {
        return view('app');
    });
    Route::get('/filtrarServicios', function () {
        return view('app');
    });
});

Route::group(['prefix' => 'cliente', 'middleware'=>['usuarioCliente']], function () {
    Route::get('/', function () {
        return view('app');
    });
    Route::get('/servicios', function () {
        return view('app');
    });
    Route::get('/verServicios', function () {
        return view('app');
    });
    Route::get('/contratar/{servicio}', function () {
        return view('app');
    });
    Route::get('/serviciosContratados', function () {
        return view('app');
    });
    Route::get('/perfil', function () {
        return view('app');
    });
    Route::get('/filtrar', function () {
        return view('app');
    });
    Route::get('/filtrarServicios', function () {
        return view('app');
    });
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

Route::post('/filtrarCategorias','CategoriaController@filtrarCategorias');
Route::post('/filtrarUbicaciones','UbicacionController@filtrarUbicaciones');
Route::post('/filtrarMetodosPagos','MetodoPagoController@filtrarMetodosPagos');
Route::post('/filtrarMinimo','ServicioController@filtrarMinimo');
Route::post('/filtrarMaximo','ServicioController@filtrarMaximo');

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

 Route::get('error', function(){
  	abort(404);
  });