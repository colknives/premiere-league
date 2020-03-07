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
            $table->string('web_name', 50);
            $table->string('photo', 50);
            $table->integer('chance_of_playing_next_round')->default(0);
            $table->integer('chance_of_playing_this_round')->default(0);
            $table->integer('code');
            $table->integer('cost_change_event')->default(0);
            $table->integer('cost_change_event_fall')->default(0);
            $table->integer('cost_change_start')->default(0);
            $table->integer('cost_change_start_fall')->default(0);
            $table->integer('dreamteam_count');
            $table->integer('element_type');
            $table->float('ep_next')->default(0.0);
            $table->float('ep_this')->default(0.0);
            $table->integer('event_points')->default(0);
            $table->float('form')->default(0.0);
            $table->boolean('in_dreamteam');
            $table->string('news', 255);
            $table->datetime('news_added');
            $table->integer('now_cost')->default(0);
            $table->float('points_per_game')->default(0.0);
            $table->float('selected_by_percent')->default(0.0);
            $table->boolean('special');
            $table->integer('squad_number')->nullable();
            $table->string('status', 20);
            $table->integer('team');
            $table->integer('team_code');
            $table->integer('total_points')->default(0);
            $table->integer('transfers_in')->default(0);
            $table->integer('transfers_in_event')->default(0);
            $table->integer('transfers_out')->default(0);
            $table->integer('transfers_out_event')->default(0);
            $table->float('value_form')->default(0.0);
            $table->float('value_season')->default(0.0);
            $table->integer('minutes');
            $table->integer('goals_scored')->default(0);
            $table->integer('assists')->default(0);
            $table->integer('clean_sheets')->default(0);
            $table->integer('goals_conceded')->default(0);
            $table->integer('own_goals')->default(0);
            $table->integer('penalties_saved')->default(0);
            $table->integer('penalties_missed')->default(0);
            $table->integer('yellow_cards')->default(0);
            $table->integer('red_cards')->default(0);
            $table->integer('saves')->default(0);
            $table->integer('bonus')->default(0);
            $table->integer('bps')->default(0);
            $table->float('influence')->default(0.0);
            $table->float('creativity')->default(0.0);
            $table->float('threat')->default(0.0);
            $table->float('ict_index')->default(0.0);
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
