<?php

declare(strict_types = 1);

namespace Tests\Feature\SettingController;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UpdateTest extends TestCase
{

    use DatabaseTransactions;

    public function test_successful_response()
    {
        $response = $this->post('/update-settings',[
            'tis_token'=>'token',
            'accountId'=>'test'
        ]);

        $response->assertStatus(200);
    }
}
