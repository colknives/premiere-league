<?php

class PlayerTest extends TestCase {

    public function testGetPlayers()
    {
        // Invalid Method
        $response = $this->post("player/list", []);
        $response->assertResponseStatus(405);

        // Success Fetch List
        $response = $this->get("player/list");
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            "message",
            "list" => [
                "*" => [
                    "player_id",
                    "full_name"
                ]
            ],
            "pagination" => [
                "total",
                "per_page",
                "current_page",
                "last_page",
                "first_page_url",
                "next_page_url",
                "prev_page_url",
                "last_page_url",
                "from",
                "to"
            ]
        ]);
    }

    public function testViewPlayer()
    {
        // Invalid Method
        $response = $this->post("player/view/abc", []);
        $response->assertResponseStatus(405);

        // Record Not Found
        $response = $this->get("player/view/abc");
        $response->assertResponseStatus(404);

        // Success Fetch List
        $response = $this->get("player/view/1");
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            "message",
            "player" => [
                "player_id",
                "first_name",
                "second_name",
                "form",
                "total_points",
                "web_name",
                "photo",
                "statistics"
            ]
        ]);
    }
}
