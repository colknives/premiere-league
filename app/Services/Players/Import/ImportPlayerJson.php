<?php

namespace App\Services\Players\Import;

use Illuminate\Support\Facades\Log;
use App\Microservices\PremierLeague\GetPlayerMicroservice;
use App\Repositories\PlayerRepository;
use Carbon\Carbon;

class ImportPlayerJson implements ImportPlayerInterface
{
	const MINIMUM_PLAYERS = 100;

	protected $playerRepository;

	protected $getPlayer;

	public function __construct(
		GetPlayerMicroservice $getPlayer,
		PlayerRepository $playerRepository)
	{
		$this->getPlayer = $getPlayer;
		$this->playerRepository = $playerRepository;
	}

	/**
	 * Import Player response in json
	 * 
     * @return boolean
     */
	public function import()
	{
		$response = $this->getPlayer->call();

		//If API access not successfull
		if( !isset($response->status) || $response->status != '200' ){
			return false;
		}

		$playerList = collect($response->result->elements);

		//If players is not within minimum required number to save
		if( $playerList->count() < static::MINIMUM_PLAYERS ){
			return false;
		}

		$batch = [];
		$successCount = 0;

		foreach( $playerList as $playerInfo ){

			//Get only needed fields and convert to array
			$info = collect($playerInfo)->toArray();

			//Prepare id and date values
			$info['player_id'] = $info['id'];
			$info['news_added'] = Carbon::parse($info['news_added'])->format('Y-m-d H:i:s');

			//Remove id key
			unset($info['id']);

			$batch[] = $info;

			//Once batch reached minimum players to insert / update, insert or update players
			if( count($batch) == static::MINIMUM_PLAYERS ){
				
				$insertUpdate = $this->playerRepository
									 ->batchInsertUpdate($batch);

				//If there are issues while inserting / updating discontinue import
				if(!$insertUpdate){
					$batch = [];
					continue;
				}

				$successCount = $successCount + count($batch);
				$batch = [];
			}
		}
	}
}
