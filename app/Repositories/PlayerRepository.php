<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Player as Model;
use Carbon\Carbon;

class PlayerRepository
{
	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function updateOrCreate($data)
	{
		return $this->model->updateOrCreate([
			'player_id' => $data->id,
		],
		[
	        "chance_of_playing_next_round" => $data->chance_of_playing_next_round,
	        "chance_of_playing_this_round" => $data->chance_of_playing_this_round,
	        "code" => $data->code,
	        "cost_change_event" => $data->cost_change_event,
	        "cost_change_event_fall" => $data->cost_change_event_fall,
	        "cost_change_start" => $data->cost_change_start,
	        "cost_change_start_fall" => $data->cost_change_start_fall,
	        "dreamteam_count" => $data->dreamteam_count,
	        "element_type" => $data->element_type,
	        "ep_next" => $data->ep_next,
	        "ep_this" => $data->ep_this,
	        "event_points" => $data->event_points,
	        "first_name" => $data->first_name,
	        "form" => $data->form,
	        "in_dreamteam" => (boolean) $data->in_dreamteam,
	        "news" => $data->news,
	        "news_added" => Carbon::parse($data->news_added)->format('Y-m-d H:i:s'),
	        "now_cost" => $data->now_cost,
	        "photo" => $data->photo,
	        "points_per_game" => $data->points_per_game,
	        "second_name" => $data->second_name,
	        "selected_by_percent" => $data->selected_by_percent,
	        "special" => (boolean) $data->special,
	        "squad_number" => (integer) $data->squad_number,
	        "status" => $data->status,
	        "team" => $data->team,
	        "team_code" => $data->team_code,
	        "total_points" => $data->total_points,
	        "transfers_in" => $data->transfers_in,
	        "transfers_in_event" => $data->transfers_in_event,
	        "transfers_out" => $data->transfers_out,
	        "transfers_out_event" => $data->transfers_out_event,
	        "value_form" => $data->value_form,
	        "value_season" => $data->value_season,
	        "web_name" => $data->web_name,
	        "minutes" => $data->minutes,
	        "goals_scored" => $data->goals_scored,
	        "assists" => $data->assists,
	        "clean_sheets" => $data->clean_sheets,
	        "goals_conceded" => $data->goals_conceded,
	        "own_goals" => $data->own_goals,
	        "penalties_saved" => $data->penalties_saved,
	        "penalties_missed" => $data->penalties_missed,
	        "yellow_cards" => $data->yellow_cards,
	        "red_cards" => $data->red_cards,
	        "saves" => $data->saves,
	        "bonus" => $data->bonus,
	        "bps" => $data->bps,
	        "influence" => $data->influence,
	        "creativity" => $data->creativity,
	        "threat" => $data->threat,
	        "ict_index" => $data->ict_index
		]);
	}

}
