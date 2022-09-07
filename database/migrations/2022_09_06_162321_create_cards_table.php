<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            /* creacion de los campos para la tabla cards */
            $table->string('id');
            $table->integer('cylinder');
            $table->date('year');
            $table->integer('torque');
            $table->integer('top_speed');
            $table->integer('weigth');
            $table->integer('name');
            $table->string('image');
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
