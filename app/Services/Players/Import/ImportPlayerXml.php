<?php

namespace App\Services\Players\Import;

use App\DataProviders\PremierLeague\GetPlayerDataProvider;
use App\Repositories\PlayerRepository;
use App\Helpers\XmlJsonConverter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ImportPlayerXml implements ImportPlayerInterface
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
	 * Import Player response in xml
	 * 
     * @return boolean
     */
	public function import()
	{
		//Sample xml response for testing
		// $xml = file_get_contents(storage_path('test/bootstrap_statistics.xml'));

		//Get data provider
		$response = $this->getPlayer->call();

		//If API access not successfull
		if( !isset($response->status) || $response->status != '200' ){
			return false;
		}

		//If result is not an xml string
		if(!is_string($response->result)){
			return false;
		}

		//Convert Xml to Json
		$xmlJsonConverter = new XmlJsonConverter($response->result);
		$results = $xmlJsonConverter->convert()->getJson();

		//Get elements and statistic field list
		$playerList = collect($results->elements);
		$playerStats = collect($results->element_stats)->pluck('name');

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
