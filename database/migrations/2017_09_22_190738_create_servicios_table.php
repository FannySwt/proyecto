<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('nombre_servicio');
            $table->string('descripcion_servicio');
            $table->string('estado')->default('inactivo');
            $table->date('fecha_publicacion_se');
            $table->date('fecha_finalizacion_se');
            $table->string('tags_servicio');
            $table->string('tipo_pago');
            $table->integer('precio_servicio');
            $table->integer('visitas')->default(0);
            $table->string('creador');
            $table->string('ubicacion')->nullable();
            $table->integer('me_gusta')->default(0);
            $table->integer('no_me_gusta')->default(0);
            $table->string('denunciado')->default('no');
            $table->integer('categoria_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           // $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
