<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Bus;
use App\Services\Players\PlayerService;

class PlayerImportScheduler extends Command {

    protected $signature = "dispatch:import_player";

    protected $playerService;

    /**
     * PlayerImportScheduler __construct method
     * 
     * @param App\Services\Players\PlayerService $playerService
     */
    public function __construct(PlayerService $playerService) {

        $this->playerService = $playerService;

        parent::__construct();
    }

    /**
     * PlayerImportScheduler handler method
     * 
     * @return boolean
     */
    public function handle() {
        Log::info('Running Import Player command.');

        $this->playerService->importPlayerJson();

        Log::info('Done Importing Player');
    }
}
