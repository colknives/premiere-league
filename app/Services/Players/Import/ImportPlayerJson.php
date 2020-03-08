<?php

namespace App\Services\Players\Import;

use App\DataProviders\PremierLeague\GetPlayerDataProvider;
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
     * @param App\DataProviders\PremierLeague\GetPlayerDataProvider $getPlayer
     * @param App\Repositories\PlayerRepository $playerRepository
     */
	public function __construct(
		GetPlayerDataProvider $getPlayer,
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
		//Get data provider
		$response = $this->getPlayer->call();

		//If API access not successfull
		if( !isset($response->status) || $response->status != '200' ){
			return false;
		}

		//Get elements and statistic field list
		$playerList = collect($response->result->elements);
		$playerStats = collect($response->result->element_stats)->pluck('name');

		//If players is not within minimum required number to save
		if( $playerList->count() < static::MINIMUM_PLAYERS ){
			return false;
		}

		foreach( $playerList as $playerInfo ){

			$statistics = [];

			//Get all statistic info
			foreach( $playerStats as $statsInfo ){
				$statistics[$statsInfo] = $playerInfo->{$statsInfo};
			}

			//Update if exist or create player
			$insertUpdate = $this->playerRepository
									 ->updateOrCreate($playerInfo, $statistics);
		}

		return true;
	}
}
