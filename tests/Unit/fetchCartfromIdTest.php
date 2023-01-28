<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class fetchCartfromId extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_fetch_cart_using_id()
    {
        
        $res=$this->get('api/getItemWithId/1');
        $res->assertStatus(200);
        $res->assertJsonStructure([
            'success',
            'data',
            'message'
        ]);
    }
}
