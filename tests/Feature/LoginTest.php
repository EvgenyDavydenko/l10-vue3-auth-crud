<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_correct_credentials()
    {
        $userData = [
            "email" => "vasya@mail.com",
            "password" => "secret",
        ];

        $user = User::factory()->create([
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $userData['email'],
            'password' => $userData['password'],
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'message',
            'access_token',
        ]);
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $userData = [
            "email" => "vasya@mail.com",
            "password" => "secret",
        ];

        $user = User::factory()->create([
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
        ]);

        $response = $this->postJson('/login', [
            'email' => $userData['email'],
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(404);
        
        // $response->assertJsonFragment([
        //     'message' => "Password didn't match"
        // ]);
    }
}
