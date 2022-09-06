<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards_match', function (Blueprint $table) {
            /* creacion de los campos para la tabla cards_match */
            $table->id();
            $table->string('fk_card');
            $table->foreign('fk_card')
                ->references('id')->on('cards')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('fk_user_match')
                ->constrained('users_match')
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
        Schema::dropIfExists('cards_match');
    }
}
