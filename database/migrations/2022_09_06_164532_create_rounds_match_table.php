<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoundsMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounds_match', function (Blueprint $table) {
            /* creacion de los campos para la tabla rounds_match */
            $table->id();
            $table->foreignId('fk_user_match')
                ->constrained('users_match')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('charasteristic');
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
        Schema::dropIfExists('rounds_match');
    }
}
