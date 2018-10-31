<?php

namespace Tests\Feature\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRequireEmailAndLogin()
    {
        $this->json('POST', 'api/login')
                ->assertStatus(422)
                ->assertJson([
                    'email'          => ['The email field is required'],
                    'description'    =>  ['The password field is required ...']

                ]);
    }

    public function  testUserLoginSuccessfully()
    {
        $user  = factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'password' => bcrypt('password1')
        ]);

        $playload = ['email' => 'testlogin@user.com', 'password'=>'password1'];

        $this->json('POST','api/login', $playload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'=> [
                    'id',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ]
            ]);
    }
}
