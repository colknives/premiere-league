<?php

namespace App\Services\Players\Import;

use App\Microservices\PremierLeague\GetPlayerMicroservice;
use App\Repositories\PlayerRepository;
use Carbon\Carbon;

class ImportPlayerJson implements ImportPlayerInterface
{
	const MINIMUM_PLAYERS = 100;

	protected $playerRepository;

	protected $getPlayer;

	/**
	 * ImportPlayerXml __construct method
	 * 
     * @param App\Microservices\PremierLeague\GetPlayerMicroservice $getPlayer
     * @param App\Repositories\PlayerRepository $playerRepository
     */
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

		foreach( $playerList as $playerInfo ){
			$insertUpdate = $this->playerRepository
									 ->updateOrCreate($playerInfo);
		}
	}
}
