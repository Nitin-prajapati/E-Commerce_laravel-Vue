<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class registrationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;
    
    public function test_a_user_can_register(){
        $user=[
           'name'=>'nitin',
           'email'=>'nitin@mail.com',
           'password'=>'12345',
           'c_password'=>'12345'
       ];
       $res=$this->post('/api/register',$user);
       $res->assertRedirect('/');
       $res->assertStatus(201);
       $res->assertJsonStructure(
        [
            'success',
            'data',
            'message'
        ]
       );

   }

   public function test_a_user_fail_to_register(){
        $user=[
            'name'=>'nitin',
            'email'=>'nitin@mail.com',
            'password'=>'12345',
            'c_password'=>'1245'
        ];
        $res=$this->post('api/register',$user);
        $res->assertStatus(400);
        $res->assertJsonStructure(['success','message']);
        
   }
}
