<?php

namespace App\Services\Players\View;

use App\Services\AbstractService;
use App\Repositories\PlayerRepository;

class ViewPlayerDetails extends AbstractService
{
	protected $id;

	protected $playerRepository;

	/**
	 * ViewPlayerDetails __construct method
	 * 
	 * @param integer $id
     * @param App\Repositories\PlayerRepository $playerRepository
     */
	public function __construct($id, PlayerRepository $playerRepository)
	{
		$this->id = $id;
		$this->playerRepository = $playerRepository;
	}

	/**
	 * ViewPlayerDetails handler
	 * 
     */
	public function handle()
	{
		$details = $this->playerRepository->viewPlayerDetails($this->id);

		if( !$details ){
			$this->response = $this->generateResponse(404, 'player.view.404');
        	$this->response->player = null;
        	return $this;
		}

		$this->response = $this->generateResponse(200, 'player.view.200');
        $this->response->player = $details;

        return $this;
	}
}
