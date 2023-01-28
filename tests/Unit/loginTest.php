<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class loginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * 
     */

    use RefreshDatabase;
    public function test_a_user_can_login()
    {
        $loginData=[
            'email'=>'nitin@mail.com',
            'password'=>'12345'
        ];

        $res=$this->post('api/login',$loginData);
        $res->assertStatus(201);
        $res->assertRedirect('/');
        
    }
}
