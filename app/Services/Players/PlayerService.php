<?php

namespace App\Services\Players;

use Illuminate\Http\Request;
use App\Repositories\PlayerRepository;
use App\Services\Players\Lists\GetPlayerList;

class PlayerService implements PlayerInterface {

    protected $playerRepository;

    public function __construct(Request $request, PlayerRepository $playerRepository) 
    {
        $this->playerRepository = $playerRepository;
        $this->request = $request;
    }

    /**
     * Get player list
     *
     * @param Array $item
     * @return type
     */
    public function getPlayerList() 
    {
        return (new GetPlayerList($this->playerRepository))->handle()->response();
    }
}
