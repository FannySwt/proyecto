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
        $usuario1 = new User(
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

        $usuario1->save();

        $usuario2 = new User(
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
        
        $usuario2->save();

        $secretaria = new Perfil_Secretaria(
            [
                'fecha_contratacion' => '2010-05-08',
            ]
        );

        $usuario2->Perfil_Secretaria()->save($secretaria);

        $usuario3 = new User(
            [
              'rut_usuario'   =>  '18454642',
              'nombre_usuario' => 'Andrea Molina',
              'domicilio_usuario' => 'Calle #1214',
              'fecha_nac' => '1994-10-14',
              'email' => 'fanny.andrea@outlook.es',
              'password' => bcrypt('cliente'),
              'tipo_usuario' => 'cliente',
              'alias' => 'ANDY',
              'telefono' => '123456788',
              ]
        ); 

        $usuario3->save();

        $cliente = new Perfil_Cliente(
            [
                'reputacion_cliente' => 0,
                'estado_cliente' => 'Activo',
                'tipo_cliente' => 'basico',
            ]
        );

        $usuario3->Perfil_cliente()->save($cliente);

        $debito = new MetodoPago(
            [
                'tipo_pago' => 'Visa Débito',
                'banco' => 'Estado',
                'tipo_cuenta' => 'Vista',
                'cantidad_cuota' => '12',
            ]
        );
        $debito->save();

        $credito = new MetodoPago(
            [
                'tipo_pago' => 'Visa Crédito',
                'banco' => 'Estado',
                'tipo_cuenta' => 'Linea de crédito',
                'cantidad_cuota' => '12',
            ]
        );
        $credito->save();

        $falabella = new MetodoPago(
            [
                'tipo_pago' => 'Tarjeta Falabella',
                'banco' => 'Estado',
                'tipo_cuenta' => 'Visa',
                'cantidad_cuota' => '6',
            ]
        );
        $falabella->save();

        $ripley = new MetodoPago(
            [
                'tipo_pago' => 'Tarjeta Ripley',
                'banco' => 'Estado',
                'tipo_cuenta' => 'Visa',
                'cantidad_cuota' => '3',
            ]
        );
        $ripley->save();
        
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
            
            ]
        );
//Usuario crea serv
        $usuario2->Servicios()->save($servicio);

        $servicio->MetodoPago()->save($debito);

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


        $usuario4 = new User(
            [
              'rut_usuario'   =>  '16457079',
              'nombre_usuario' => 'Tamara Molina',
              'domicilio_usuario' => 'Calle #1214',
              'fecha_nac' => '1994-10-14',
              'email' => 'cliente2@hotmail.com',
              'password' => bcrypt('cliente2'),
              'tipo_usuario' => 'cliente',
              'alias' => 'TAMARA',
              'telefono' => '123456088',
              ]
        ); 

        $usuario4->save();

        $cliente = new Perfil_Cliente(
            [
                'reputacion_cliente' => 0,
                'estado_cliente' => 'Activo',
                'tipo_cliente' => 'basico',
            ]
        );

        $usuario4->Perfil_cliente()->save($cliente);
         
        //Usuario Contrata servicio

        $usuario3->ServiciosContratados()->save($servicio,
            ['fecha_contratacion' => '2010-05-01',
            'fecha_fin_contratacion' => '2010-06-05',
            'descuento_tipo_cliente' => '10%',
            'tipo_pago' => 'credito',
            'numero_tarjeta' => 90000,
            'numero_cuota' => 3,
            'valor_cuota' =>2000
            ]
        );







         $educacion = new Categoria(//1
      [
        'nombre_categoria'    =>  'Educacion',
        'descripcion_categoria'    =>  'servicios relacionados a la educacion',
        'estado_categoria'    =>  'Activo',
        'cantidad_publicaciones'    =>  1,
        'edad_recomendada'  => 0
        ]
    );
        $educacion->save();

    $electro = new Categoria(//2
      [
        'nombre_categoria'    =>  'Electro',
        'descripcion_categoria'    =>  'servicios relacionados a equipos electronicos',
        'estado_categoria'    =>  'Activo',
        'cantidad_publicaciones'    =>  1,
        'edad_recomendada'  => 12
        ]
    );
        $electro->save();

    $salud = new Categoria(//3
      [
        'nombre_categoria'    =>  'Salud',
        'descripcion_categoria'    =>  'servicios relacionados con el area salud',
        'estado_categoria'    =>  'Activo',
        'cantidad_publicaciones'    =>  1,
        'edad_recomendada'  => 18
        ]
    );
        $salud->save();
        
    $automoviles = new Categoria(//4
      [
        'nombre_categoria'    =>  'Automoviles',
        'descripcion_categoria'    =>  'servicios relacionados a vehiculos motorizados',
        'estado_categoria'    =>  'Activo',
        'cantidad_publicaciones'    =>  1,
        'edad_recomendada'  => 0
        ]
    );  
        $automoviles->save();

    $cumple = new Categoria(//5
      [
        'nombre_categoria'    =>  'Cumpleaños',
        'descripcion_categoria'    =>  'servicios relacionados a fiestas de cumpleaños',
        'estado_categoria'    =>  'Activo',
        'cantidad_publicaciones'    =>  1,
        'edad_recomendada'  => 1
        ]
    );   
        $cumple->save();

    $jardin = new Categoria(//6
      [
        'nombre_categoria'    =>  'Jardin',
        'descripcion_categoria'    =>  'servicios relacionados con jardineria',
        'estado_categoria'    =>  'Activo',
        'cantidad_publicaciones'    =>  2,
        'edad_recomendada'  => 14
        ]
    );   
        $jardin->save();
    
    $deporte = new Categoria(//7
      [
        'nombre_categoria'    =>  'Deporte',
        'descripcion_categoria'    =>  'servicios relacionados con deportes o actividad fisica',
        'estado_categoria'    =>  'Activo',
        'cantidad_publicaciones'    =>  2,
        'edad_recomendada'  => 8
        ]
    );    
        $deporte->save();

    $hogar = new Categoria(//8
      [
        'nombre_categoria'    =>  'Hogar',
        'descripcion_categoria'    =>  'servicios relacionados a hogar',
        'estado_categoria'    =>  'Activo',
        'cantidad_publicaciones'    =>  1,
        'edad_recomendada'  => 18
        ]
    );
        $hogar->save();

        





         $servicio = new Servicio(
      [
        'nombre_servicio'   =>  'Mecanico a domicilio',
        'descripcion_servicio' => 'Se reparan automoviles y motocicletas a domicilio , rapido y facil',
        'estado' => 'activo',
        'fecha_publicacion_se' => '2017-03-21',
        'fecha_finalizacion_se' => '2017-04-29',
        'tags_servicio' => '#automoviles',
        'precio_servicio' => 21000,
        'tipo_pago' => 'Visa Débito',
        'visitas' => 50,
        'creador' => '24',
        'ubicacion' => 'septima region',
        'me_gusta' => 0,
        'no_me_gusta' => 0,
        ]
    );

    $usuario2->Servicios()->save($servicio);
    $servicio->MetodoPago()->save($debito);
    $automoviles->Servicio()->save($servicio);

    
    

    $servicio = new Servicio(
      [
        'nombre_servicio'   =>  'Medico a domicilio',
        'descripcion_servicio' => 'Medico ofrece sus servicios de consulta a domicilio dentro de talca',
        'estado' => 'activo',
        'fecha_publicacion_se' => '2017-03-21',
        'fecha_finalizacion_se' => '2017-12-30',
        'tags_servicio' => '#salud',
        'precio_servicio' => 45000,
        'tipo_pago' => 'Visa Crédito',
        'visitas' => 500,
        'creador' => '24',
        'ubicacion' => 'cuarta region',
        'me_gusta' => 0,
        'no_me_gusta' => 0,
        ]
    ); 
    $usuario2->Servicios()->save($servicio);
    $servicio->MetodoPago()->save($credito);
    $salud->Servicio()->save($servicio);


    $servicio = new Servicio(
      [
        'nombre_servicio'   =>  'Reparacion de equipos electronicos',
        'descripcion_servicio' => 'Se reparan celulares y computadores marca samsung',
        'estado' => 'activo',
        'fecha_publicacion_se' => '2017-10-15',
        'fecha_finalizacion_se' => '2017-12-21',
        'tags_servicio' => '#electro',
        'precio_servicio' => 15000,
        'tipo_pago' => 'Tarjeta Falabella',
        'visitas' => 23,
        'creador' => '24',
        'ubicacion' => 'octava region',
        'me_gusta' => 0,
        'no_me_gusta' => 0,
        ]
    );
    $usuario2->Servicios()->save($servicio);
    $servicio->MetodoPago()->save($falabella);
    $electro->Servicio()->save($servicio);
  

    $servicio = new Servicio(
      [
        'nombre_servicio'   =>  'Profesor de matematicas',
        'descripcion_servicio' => 'Servicio de tutor de matematicas de 2do a 8vo basico',
        'estado' => 'inactivo',
        'fecha_publicacion_se' => '2017-03-28',
        'fecha_finalizacion_se' => '2017-12-28',
        'tags_servicio' => '#educacion',
        'precio_servicio' => 15000,
        'tipo_pago' => 'Visa Crédito',
        'visitas' => 75,
        'creador' => '24',
        'ubicacion' => 'valparaiso',
        'me_gusta' => 0,
        'no_me_gusta' => 0,
        ]
    );
    $usuario3->Servicios()->save($servicio);
    $servicio->MetodoPago()->save($credito);
    $educacion->Servicio()->save($servicio);
  


    $servicio = new Servicio(
      [
        'nombre_servicio'   =>  'Entrenador de tenis',
        'descripcion_servicio' => 'Entrenamientos personalizados cada semana',
        'estado' => 'activo',
        'fecha_publicacion_se' => '2017-04-28',
        'fecha_finalizacion_se' => '2017-12-18',
        'tags_servicio' => '#deporte',
        'precio_servicio' => 15500,
        'tipo_pago' => 'Tarjeta Ripley',
        'visitas' => 15,
        'creador' => '24',
        'ubicacion' => 'chile',
        'me_gusta' => 0,
        'no_me_gusta' => 0,
        ]
    );
    $usuario3->Servicios()->save($servicio);
    $servicio->MetodoPago()->save($ripley);
    $deporte->Servicio()->save($servicio);
  


    $servicio = new Servicio(
      [
        'nombre_servicio'   =>  'Limpieza de piscinas',
        'descripcion_servicio' => 'Servicio de Limpieza de piscinas fines de semana',
        'estado' => 'activo',
        'fecha_publicacion_se' => '2017-03-27',
        'fecha_finalizacion_se' => '2017-12-31',
        'tags_servicio' => '#jardin',
        'tipo_pago' => 'Visa Débito',
        'precio_servicio' => 10000,
        'visitas' => 75,
        'creador' => '24',
        'ubicacion' => 'punta arenas',
        'me_gusta' => 6,
        'no_me_gusta' => 200,
        ]
    );
    $usuario4->Servicios()->save($servicio);
    $servicio->MetodoPago()->save($debito);
    $jardin->Servicio()->save($servicio);
  


    $servicio = new Servicio(
      [
        'nombre_servicio'   =>  'Jardineria',
        'descripcion_servicio' => 'Se ofrece servicio de jardineria para fines de semana',
        'estado' => 'activo',
        'fecha_publicacion_se' => '2017-01-28',
        'fecha_finalizacion_se' => '2017-2-28',
        'tags_servicio' => '#jardin',
        'tipo_pago' => 'Tarjeta Falabella',
        'precio_servicio' => 15000,
        'visitas' => 5,
        'creador' => '24',
        'ubicacion' => 'canada',
        'me_gusta' => 0,
        'no_me_gusta' => 0,
        ]
    );
    $usuario4->Servicios()->save($servicio);
    $servicio->MetodoPago()->save($falabella);
    $jardin->Servicio()->save($servicio);
  


    $servicio = new Servicio(
      [
        'nombre_servicio'   =>  'Decoracion interiores',
        'descripcion_servicio' => 'Diseñardora de ambientes ofrece servicios para decorar',
        'estado' => 'activo',
        'fecha_publicacion_se' => '2017-01-28',
        'fecha_finalizacion_se' => '2017-02-28',
        'tags_servicio' => '#hogar',
        'precio_servicio' => 150000,
        'tipo_pago' => 'Tarjeta Falabella',
        'visitas' => 5,
        'creador' => '24',
        'ubicacion' => 'talca',
        'me_gusta' => 30,
        'no_me_gusta' => 0,
        ]
    );
    $usuario3->Servicios()->save($servicio);
    $servicio->MetodoPago()->save($falabella);
    $hogar->Servicio()->save($servicio);
  


    $servicio = new Servicio(
      [
        'nombre_servicio'   =>  'Entrenador Personal',
        'descripcion_servicio' => 'Se ofrece servicio de Entrenador personal miercoles y viernes',
        'estado' => 'activo',
        'fecha_publicacion_se' => '2017-01-28',
        'fecha_finalizacion_se' => '2017-02-28',
        'tags_servicio' => '#deporte',
        'precio_servicio' => 120000,
        'tipo_pago' => 'Visa Débito',
        'visitas' => 5,
        'creador' => '24',
        'ubicacion' => 'linares',
        'me_gusta' => 0,
        'no_me_gusta' => 0,
        ]
    );
    $usuario3->Servicios()->save($servicio);
    $servicio->MetodoPago()->save($debito);
    $deporte->Servicio()->save($servicio);
  

        


    }
}
