<?php

namespace App\Services\Players\Import;

use App\Microservices\PremierLeague\GetPlayerMicroservice;
use App\Repositories\PlayerRepository;
use Carbon\Carbon;

class ImportPlayerXml implements ImportPlayerInterface
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
	 * Import Player response in xml
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

		//If result is not an xml string
		if(!is_string($response->result)){
			return false;
		}

		//Convert Xml to Array
		$results = $this->convertXmlToArray($response->result);

		//Clean data from xml for possibility of null values
		$results = $this->cleanXmlData($results['elements']['element']);

		$playerList = collect($results);

		// If players is not within minimum required number to save
		if( $playerList->count() < static::MINIMUM_PLAYERS ){
			return false;
		}

		foreach( $playerList as $playerInfo ){
			$insertUpdate = $this->playerRepository
									 ->updateOrCreate($playerInfo);
		}
	}

	/**
	 * Clean data from xml
	 * 
	 * @param $data
     * @return json
     */
	private function cleanXmlData($data)
	{
		foreach( $data as $dataKey => $dataInfo ){
			foreach( $dataInfo as $infoKey => $infoValue ){
				$data[$dataKey][$infoKey] = ( is_array($infoValue) )? "" : $infoValue;
			}
		}

		return json_decode(json_encode($data));
	}

	/**
	 * Convert xml to array
	 * 
	 * @param $xml
     * @return array
     */
	private function convertXmlToArray($xml)
	{
		$xml = simplexml_load_string($xml);
		return json_decode(json_encode($xml), TRUE);
	}
}
