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
            $table->string('chance_of_playing_next_round', 10)->nullable();
            $table->string('chance_of_playing_this_round', 10)->nullable();
            $table->string('code')->nullable();
            $table->string('cost_change_event', 10)->nullable();
            $table->string('cost_change_event_fall', 10)->nullable();
            $table->string('cost_change_start', 10)->nullable();
            $table->string('cost_change_start_fall', 10)->nullable();
            $table->string('dreamteam_count')->nullable();
            $table->string('element_type', 10)->nullable();
            $table->string('ep_next', 10)->nullable();
            $table->string('ep_this', 10)->nullable();
            $table->string('event_points', 10)->nullable();
            $table->string('form', 10)->nullable();
            $table->string('in_dreamteam')->nullable();
            $table->string('news', 255)->nullable();
            $table->datetime('news_added')->nullable();
            $table->string('now_cost', 10)->nullable();
            $table->string('points_per_game', 10)->nullable();
            $table->string('selected_by_percent', 10)->nullable();
            $table->string('special', 10)->nullable();
            $table->string('squad_number', 10)->nullable();
            $table->string('status', 20)->nullable();
            $table->string('team', 10)->nullable();
            $table->string('team_code', 10)->nullable();
            $table->string('total_points', 10)->nullable();
            $table->string('transfers_in', 10)->nullable();
            $table->string('transfers_in_event', 10)->nullable();
            $table->string('transfers_out', 10)->nullable();
            $table->string('transfers_out_event', 10)->nullable();
            $table->string('value_form', 10)->nullable();
            $table->string('value_season', 10)->nullable();
            $table->string('minutes')->nullable();
            $table->string('goals_scored', 10)->nullable();
            $table->string('assists', 10)->nullable();
            $table->string('clean_sheets', 10)->nullable();
            $table->string('goals_conceded', 10)->nullable();
            $table->string('own_goals', 10)->nullable();
            $table->string('penalties_saved', 10)->nullable();
            $table->string('penalties_missed', 10)->nullable();
            $table->string('yellow_cards', 10)->nullable();
            $table->string('red_cards', 10)->nullable();
            $table->string('saves', 10)->nullable();
            $table->string('bonus', 10)->nullable();
            $table->string('bps', 10)->nullable();
            $table->string('influence', 10)->nullable();
            $table->string('creativity', 10)->nullable();
            $table->string('threat', 10)->nullable();
            $table->string('ict_index', 10)->nullable();
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
