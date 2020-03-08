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
                "next_page_url",
                "prev_page_url",
                "last_page_url",
                "from",
                "to"
            ]
        ]);
    }

 //    public function testVoucherList() {

 //        $user = Uuid::uuid4()->toString();
 //        $merchant = Uuid::uuid4()->toString();

 //        $voucher = factory(\App\Models\Voucher::class, 10)->create([
 //            'merchant_uuid' => $merchant
 //        ]);

 //        //list order
 //        $response = $this->post("v1/cms/voucher/list", [
 //            "keyword" => "",
 //            "filter" => "active"
 //        ], $this->getMerchantHeader($user, $merchant));
 //        $response->assertResponseStatus(200);
 //        $response->seeJsonStructure([
 //            "message",
 //            "list" => [
 //                "*" => [
 //                    "name",
 //                    "description",
 //                    "type",
 //                    "value_type",
 //                    "value",
 //                    "image",
 //                    "absolute",
 //                    "quantity",
 //                    "validity_type",
 //                    "validity_days",
 //                    "validity_start_date",
 //                    "validity_end_date",
 //                    "visibility"
 //                ]
 //            ],
 //            "max_page",
 //            "next_page",
 //            "prev_page"
 //        ]);
 //    }

 //    public function testExportPackage() {

 //        $user = Uuid::uuid4()->toString();
 //        $merchant = Uuid::uuid4()->toString();

 //        $voucher = factory(\App\Models\Voucher::class, 10)->create([
 //            'merchant_uuid' => $merchant
 //        ]);

 //        //list order
 //        $response = $this->post("v1/cms/voucher/export", [
 //            "keyword" => "",
 //            "filter" => "active"
 //        ], $this->getMerchantHeader($user, $merchant));
 //        $response->assertResponseStatus(200);
 //        $response->seeJsonStructure([
 //            "message",
 //            "url"
 //        ]);
 //    }

 //    public function testViewVoucher() {

 //        $user = Uuid::uuid4()->toString();
 //        $merchant = Uuid::uuid4()->toString();
 //        // $merchant = 'ec821e95-1175-4098-8bac-a9ef37adf4d8';

 //        $voucher = factory(\App\Models\Voucher::class)->create([
 //            // 'uuid' => 'f191f646-2088-4af9-81c5-1570070f11e3',
 //            'merchant_uuid' => $merchant
 //        ]);
        
 //        //200
 //        $response = $this->get("v1/cms/voucher/view/{$voucher->uuid}", $this->getMerchantHeader($user, $merchant));
 //        $response->assertResponseStatus(200);
 //        $response->seeJsonStructure([
 //            "message",
 //            "model" => [
 //                "name",
 //                "description",
 //                "type",
 //                "value_type",
 //                "value",
 //                "image",
 //                "absolute",
 //                "quantity",
 //                "validity_type",
 //                "validity_days",
 //                "validity_start_date",
 //                "validity_end_date",
 //                "validity_start_grace_period",
 //                "validity_end_grace_period",
 //                "visibility",
 //                "attached_to_package"
 //            ]
 //        ]);
 //    }

 //    public function testUpdateVoucher() {
 //        $user = Uuid::uuid4()->toString();
 //        $merchant = Uuid::uuid4()->toString();
 //        // $merchant = 'ec821e95-1175-4098-8bac-a9ef37adf4d8';

 //        //403
 //        $response = $this->post("v1/cms/voucher/update/1", []);
 //        $response->assertResponseStatus(403);

 //        //422
 //        $response = $this->post("v1/cms/voucher/update/1", [], $this->getMerchantHeader($user, $merchant));
 //        $response->assertResponseStatus(422);
 //        $response->seeJsonStructure([
 //            "name",
 //            "description"
 //        ]);

 //        $voucher = factory(\App\Models\Voucher::class)->create([
 //            // 'uuid' => 'f191f646-2088-4af9-81c5-1570070f11e3',
 //            'merchant_uuid' => $merchant,
 //            'for_bundle' => 0,
 //            'absolute' => 0,
 //            'quantity' => 1,
 //            'visibility' => 0
 //        ]);

 //        $response = $this->post("v1/cms/voucher/update/{$voucher->uuid}", [
 //            "name" => $voucher->name,
 //            "description" => $voucher->description,
 //            "type" => 'item',
 //            "value_type" => $voucher->value_type,
 //            "value" => $voucher->value_type,
 //            "image" => $voucher->value_type,
 //            "absolute" => 0,
 //            "quantity" => 1,
 //            "validity_type" => $voucher->validity_type,
 //            "validity_days" => $voucher->validity_days,
 //            "validity_start_date" => $voucher->validity_start_date,
 //            "validity_end_date" => $voucher->validity_end_date,
 //            "validity_start_grace_period" => $voucher->validity_start_grace_period,
 //            "validity_end_grace_period" => $voucher->validity_end_grace_period,
 //            "visibility" => 1,
 //                ], $this->getMerchantHeader($user, $merchant));
 //        $response->assertResponseStatus(200);
 //        $response->seeJsonStructure([
 //            'message'
 //        ]);
 //    }

 //    public function testDeleteVoucher() {
 //        $user = Uuid::uuid4()->toString();
 //        $merchant = Uuid::uuid4()->toString();
 //        // $merchant = 'ec821e95-1175-4098-8bac-a9ef37adf4d8';

 //        //403
 //        $response = $this->post("v1/cms/voucher/delete", []);
 //        $response->assertResponseStatus(403);

 //        //422
 //        $response = $this->post("v1/cms/voucher/delete", [], $this->getMerchantHeader($user, $merchant));
 //        $response->assertResponseStatus(422);
 //        $response->seeJsonStructure([
 //            "uuid"
 //        ]);

 //        $voucher = factory(\App\Models\Voucher::class)->create([
 //            // 'uuid' => 'f191f646-2088-4af9-81c5-1570070f11e3',
 //            'merchant_uuid' => $merchant
 //        ]);

 //        $response = $this->post("v1/cms/voucher/delete", [
 //            "uuid" => $voucher->uuid
 //                ], $this->getMerchantHeader($user, $merchant));
 //        $response->assertResponseStatus(200);
 //        $response->seeJsonStructure([
 //            'message'
 //        ]);
 //    }

}
