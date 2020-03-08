<?php

namespace App\Services\Players\Lists;

use App\Services\AbstractService;
use App\Repositories\PlayerRepository;

class GetPlayerList extends AbstractService
{
	const PER_LIST = 10;

	protected $playerRepository;

	/**
	 * GetPlayerList __construct method
	 * 
	 * @param integer $page
     * @param App\Repositories\PlayerRepository $playerRepository
     */
	public function __construct(PlayerRepository $playerRepository)
	{
		$this->playerRepository = $playerRepository;
	}

	/**
	 * GetPlayerList handler
	 * 
     */
	public function handle()
	{
		$getList = $this->playerRepository->getPlayerList(static::PER_LIST);

		$this->response = $this->generateResponse(200, 'player.list.200');
        $this->response->list = json_decode($getList->toJson());

        return $this;
	}
}
