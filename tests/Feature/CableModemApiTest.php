<?php


namespace Tests\Feature;


use Tests\TestCase;

class CableModemApiTest extends TestCase
{
    /**
     * @test
     * @testdox verify endpoint is working
     */
    public function caseOne()
    {
        $this->json('GET','/api/v1/modems')
            ->assertStatus(200)
            ->assertJson([
                'code' => 200,
                'message' => 'OK'
            ]);
    }
}
