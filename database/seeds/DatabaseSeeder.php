<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Perfil_Secretaria;
use App\Perfil_Cliente;
use App\Servicio;
use App\Categoria;
use App\Metodoo_Pago;
use App\Ubicacion;
use App\Metodopago;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $usuario = new User(
            [
              'rut_usuario'   =>  '19105288',
              'nombre_usuario' => 'SILVA ESTEFANIA',
              'domicilio_usuario' => 'Calle #1234',
              'fecha_nac' => '1994-10-14',
              'email' => 'admin@hotmail.com',
              'password' => bcrypt('admin'),
              'tipo_usuario' => 'admin',
              'alias' => 'FANNY',
              'telefono' => '123456789',
              ]
        ); 

        $usuario->save();

        $usuario = new User(
            [
              'rut_usuario'   =>  '17878649',
              'nombre_usuario' => 'Luis Muñoz',
              'domicilio_usuario' => 'Calle #1235',
              'fecha_nac' => '1994-10-14',
              'email' => 'secretaria@hotmail.com',
              'password' => bcrypt('secretaria'),
              'tipo_usuario' => 'secretaria',
              'alias' => 'PIPE',
              'telefono' => '123456787',
              ]
        ); 
        
        $usuario->save();

        $secretaria = new Perfil_Secretaria(
            [
                'fecha_contratacion' => '2010-05-08',
            ]
        );

        $usuario->Perfil_Secretaria()->save($secretaria);

        $usuario = new User(
            [
              'rut_usuario'   =>  '18454642',
              'nombre_usuario' => 'Andrea Molina',
              'domicilio_usuario' => 'Calle #1214',
              'fecha_nac' => '1994-10-14',
              'email' => 'cliente@hotmail.com',
              'password' => bcrypt('cliente'),
              'tipo_usuario' => 'cliente',
              'alias' => 'ANDY',
              'telefono' => '123456788',
              ]
        ); 

        $usuario->save();

        $cliente = new Perfil_Cliente(
            [
                'reputacion_cliente' => 0,
                'estado_cliente' => 'Activo',
                'tipo_cliente' => 'basico',
            ]
        );

        $usuario->Perfil_cliente()->save($cliente);

        $pago = new MetodoPago(
            [
                'tipo_pago' => 'Tarjeta',
                'banco' => 'Estado',
                'tipo_cuenta' => 'Cuenta Rut',
                'cantidad_cuota' => '3',
            ]
        );
        $pago->save();
        
        $servicio = new Servicio(
            [
                'nombre_servicio'   =>  'Arriendo Juegos Inflables',
                'descripcion_servicio' => 'Se arriendan juegos para fiestas de cumpleaños para niños',
                'estado' => 'activo',
                'fecha_publicacion_se' => '2017-03-19',
                'fecha_finalizacion_se' => '2017-04-28',
                'tags_servicio' => '#cumpleaños',
                'tipo_pago' => 'Tarjeta',
                'precio_servicio' => 150000,
                'visitas' => 150,
                'creador' => 'Andrea Molina',
                'ubicacion' => 'cuarta region ',
                'reputacion' => 0,
            ]
        );
//Usuario crea serv
        $usuario->Servicios()->save($servicio);

        $servicio->MetodoPago()->save($pago);

        $categoria = new Categoria(
            [
                'nombre_categoria' => 'Infantil',
                'descripcion_categoria' => 'Servicio de entrentención',
                'estado_categoria' => 'Activo',
                'cantidad_publicaciones' => 1,
                'edad_recomendada' => 5,
            ]
        );
        $categoria->save();

        $categoria->Servicio()->save($servicio);


        

        $ubicacion = new Ubicacion(
            [
                'calle' => '2 oriente',
                'numero_casa' => '196',
            ]
        );
                //hasMany guarda a belongsToMany
        $servicio->Ubicacion()->save($ubicacion);


        $usuario = new User(
            [
              'rut_usuario'   =>  '16457079',
              'nombre_usuario' => 'Tamara Molina',
              'domicilio_usuario' => 'Calle #1214',
              'fecha_nac' => '1994-10-14',
              'email' => 'tamara@hotmail.es',
              'password' => bcrypt('16457079'),
              'tipo_usuario' => 'cliente',
              'alias' => 'TAMARA',
              'telefono' => '123456088',
              ]
        ); 

        $usuario->save();

        $cliente = new Perfil_Cliente(
            [
                'reputacion_cliente' => 0,
                'estado_cliente' => 'Activo',
                'tipo_cliente' => 'basico',
            ]
        );

        $usuario->Perfil_cliente()->save($cliente);
         
        //Usuario Contrata servicio

        $usuario->ServiciosContratados()->save($servicio,
            ['fecha_contratacion' => '2010-05-01',
            'fecha_fin_contratacion' => '2010-06-05',
            'descuento_tipo_cliente' => '10%',
            'tipo_pago' => 'Tarjeta',
            'numero_tarjeta' => 90000,
            'numero_cuota' => 3,
            'valor_cuota' =>2000
            ]
        );

        
        


    }
}
