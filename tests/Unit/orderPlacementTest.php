<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Auth\Authenticatable;

class orderPlacementTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;
    use Authenticatable;

    public function test_order_fail_for_unauthenticated_user(){
        $req=['desc'=>'This is decription','amt'=>100];
        $res=$this->post('api/placeOrder',$req);
        $res->assertStatus(400);
        // dd($res->getData());
        $this->assertEquals('Auth Failure',$res->getData());
    }

    public function test_order_place_for_authenticated_user(){
        
        $user=new User();
        $user->name='User';
        $user->email='user@email.com';
        $user->password='12345';
        $this->actingAs($user);


        $req=['desc'=>'This is decription','amt'=>100,'user_id'=>1];

        
        $res=$this->post('api/placeOrder',$req);
        $res->assertStatus(201);
        $this->assertEquals($res->getData(),'Order Successful');
        
    }
}
