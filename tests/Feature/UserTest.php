<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function test_example_auth()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/');

        $response->assertStatus(200);
    }

    public function test_example_not_auth()
    {
        $user = [
            "email" => "eduruelas13@gmail.com",
            "password" => "123456789"
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/');

        $response->assertStatus(200);
    }

}
