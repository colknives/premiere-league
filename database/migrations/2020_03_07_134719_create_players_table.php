<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('player_id');
            $table->string('first_name', 50);
            $table->string('second_name', 50);
            $table->string('form', 10)->nullable();
            $table->string('total_points', 10)->nullable();
            $table->string('web_name', 50);
            $table->string('photo', 50);
            $table->text('statistics');
            $table->timestamps();
            $table->index(['player_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
