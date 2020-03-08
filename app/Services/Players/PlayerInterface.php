<?php

namespace App\Services\Players;

interface PlayerInterface {

    public function importPlayerJson();

    public function importPlayerXml();

    public function getPlayerList();
}
