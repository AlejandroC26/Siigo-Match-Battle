<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_match', function (Blueprint $table) {
            /* creacion de los campos para la tabla users_match */
            $table->id();
            $table->enum('state',['active','inactive','finish']);
            $table->foreignId('fk_user')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('fk_match')
                ->constrained('match')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('users_match');
    }
}
