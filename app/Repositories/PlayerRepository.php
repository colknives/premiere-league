<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Player as Model;
use Carbon\Carbon;

class PlayerRepository
{
	protected $model;

	/**
	 * PlayerRepository __construct method
	 * 
     * @param Model $model
     */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	/**
	 * Update if exist or create player
	 * 
     * @param object $data
     * @param array $statistics
     */
	public function updateOrCreate($data = false, $statistics = [])
	{
		//If no data provided, return false
		if( !$data ){
			return false;
		}

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
	        'statistics' => $statistics
		]);
	}

	/**
	 * Get player list
	 * 
     * @param integer $perPage
     */
	public function getPlayerList($perPage)
	{
		return $this->model
					->select([
						'player_id',
						DB::raw('CONCAT(first_name, " ", second_name) as full_name')
					])
					->paginate($perPage);
	}

	/**
	 * View player details
	 * 
     * @param integer $id
     */
	public function viewPlayerDetails($id)
	{
		return $this->model
		            ->where('player_id', $id)
		            ->first();
	}
}
