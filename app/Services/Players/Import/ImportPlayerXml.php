<?php

namespace App\Services\Players\Import;

use App\Repositories\PlayerRepository;

class ImportPlayerXml implements ImportPlayerInterface
{
	protected $playerRepository;

	public function __construct(PlayerRepository $playerRepository)
	{
		$this->playerRepository = $playerRepository;
	}

	public function import()
	{
		dd('huy');
	}
}
