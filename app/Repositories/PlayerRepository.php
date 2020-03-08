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

	public function updateOrCreate($data, $statistics)
	{
		return $this->model->updateOrCreate([
			'player_id' => $data->id,
		],
		[
	        'first_name' => $data->first_name,
	        'first_namesecond_name' => $data->second_name,
	        'second_name' => $data->second_name,
	        'form' => $data->form,
	        'total_points' => $data->total_points,
	        'web_name' => $data->web_name,
	        'photo' => $data->photo,
	        'statistics' => json_encode($statistics)
		]);
	}

}
