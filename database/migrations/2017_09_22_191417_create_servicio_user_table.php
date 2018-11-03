<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicioUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('servicio_id')->unsigned();
            $table->date('fecha_contratacion');
            $table->date('fecha_fin_contratacion');
            $table->string('descuento_tipo_cliente');
            $table->string('tipo_pago');
            $table->integer('numero_tarjeta');
            $table->integer('numero_cuota');
            $table->integer('valor_cuota');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
            /*pago? para un tema de preferencia*/ 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio_user');
    }
}
