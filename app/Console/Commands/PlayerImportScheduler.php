<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Bus;
use App\Services\Players\Import\ImportPlayerXml as ImportPlayer;

class PlayerImportScheduler extends Command {

    protected $signature = "dispatch:import_player";

    protected $importPlayer;

    public function __construct(
        ImportPlayer $importPlayer) {

        $this->importPlayer = $importPlayer;

        parent::__construct();
    }

    public function handle() {
        Log::info('Running Import Player command.');

        $notify = $this->importPlayer->import();

        Log::info('Done Importing Player');
    }
}
