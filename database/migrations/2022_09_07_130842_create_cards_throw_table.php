<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsThrowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards_throw', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_cards_match')
                ->constrained('cards_match')
                ->onDelete('cascade')
                ->onCascade('cascade');
            $table->foreignId('fk_round_match')
                ->constrained('rounds_match')
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
        Schema::dropIfExists('cards_throw');
    }
}
