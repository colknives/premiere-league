<?php

namespace App\Http\Controllers;

use App\Services\Players\PlayerService;

class PlayerController extends Controller
{
    protected $playerService;

    public function __construct(PlayerService $playerService) 
    {
        $this->playerService = $playerService;
    }

    /**
     * Get player list
     *
     * @param integer $page
     */
    public function getPlayers() 
    {
        $getList = $this->playerService->getPlayerList();

        return response()->json([
            "message" => $getList->message,
            "list" => $getList->list->data,
            "pagination" => [
                "total" => $getList->list->total,
                "per_page" => $getList->list->per_page,
                "current_page" => $getList->list->current_page,
                "last_page" => $getList->list->last_page,
                "next_page_url" => $getList->list->next_page_url,
                "prev_page_url" => $getList->list->prev_page_url,
                "last_page_url" => $getList->list->last_page_url,
                "from" => $getList->list->from,
                "to" => $getList->list->to
            ]
        ], $getList->status);
    }
}
