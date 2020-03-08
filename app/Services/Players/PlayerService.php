<?php

namespace App\Services\Players;

use Illuminate\Http\Request;
use App\Repositories\PlayerRepository;
use App\DataProviders\PremierLeague\GetPlayerDataProvider;
use App\Services\Players\Lists\GetPlayerList;
use App\Services\Players\Import\ImportPlayerJson;
use App\Services\Players\Import\ImportPlayerXml;

class PlayerService implements PlayerInterface {

    protected $playerRepository;

    protected $getPlayerDataProvider;

    public function __construct(
        Request $request, 
        PlayerRepository $playerRepository,
        GetPlayerDataProvider $getPlayerDataProvider) 
    {
        $this->playerRepository = $playerRepository;
        $this->getPlayerDataProvider = $getPlayerDataProvider;
        $this->request = $request;
    }

    /**
     * Import player in json format
     *
     * @return boolean
     */
    public function importPlayerJson() 
    {
        return (new ImportPlayerJson($this->getPlayerDataProvider, $this->playerRepository))->import();
    }

    /**
     * Import player in xml format
     *
     * @return boolean
     */
    public function importPlayerXml() 
    {
        return (new ImportPlayerXml($this->getPlayerDataProvider, $this->playerRepository))->import();
    }

    /**
     * Get player list
     *
     * @return object
     */
    public function getPlayerList() 
    {
        return (new GetPlayerList($this->playerRepository))->handle()->response();
    }
}
