<?php

namespace App\Microservices\PremierLeague;

use App\Microservices\AbstractMicroservice;

class GetPlayerMicroservice extends AbstractMicroservice
{
	protected $method = 'GET';

	protected $baseUrl = 'https://fantasy.premierleague.com';

    protected $url = '/api/bootstrap-static/';

    protected $headers = [
        'User-Agent' => 'GuzzleHttp/6.5'
    ];

    public function __construct()
    {
        parent::__construct();
    }
}
