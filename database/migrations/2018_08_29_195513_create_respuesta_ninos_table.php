<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaNinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuesta_ninos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('nino_id');
            $table->foreign('nino_id')->references('id')->on('ninos');
            $table->date('fecha_realizacion');
            $table->integer('r1');
            $table->integer('r2');
            $table->integer('r3');
            $table->integer('r4');
            $table->integer('r5');
            $table->integer('r6');
            $table->integer('r7');
            $table->integer('r8');
            $table->integer('r9');
            $table->integer('r10');
            $table->integer('r11');
            $table->integer('r12');
            $table->integer('r13');
            $table->integer('r14');
            $table->integer('r15');
            $table->integer('r16');
            $table->integer('r17');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuesta_ninos');
    }
}
