<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegistersSuccessfully()
    {
        $payload =[
            'name'                  => 'John',
            'email'                 => 'john@gmail.com',
            'password'              =>  'admin123',
            'password_confirmation' => 'admin123',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' =>[
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at'
                ],
            ]);
    }

    public function  testsRequiresPasswordEmailAndName()
    {
        $this->json('post', 'api/register')
            ->assertStatus(422)
            ->assertJson([
                'name'          => ['The name field is required'],
                'email'         => ['The email field is required'],
                'password'      => ['The password field is required'],
            ]);
    }

    public function  testsRequirePasswordConfirmation()
    {
        $playload =[
            'name'      => 'John',
            'name'      => 'john@gmail.com',
            'pasword'   => 'admin123',
        ];

        $this->json('post', '/api/register', $playload)
            ->assertStatus(422)
            ->assertJson([
                'password' => ['The password confirmation does not match'],
            ]);
    }
}







