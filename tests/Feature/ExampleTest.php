<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_auth()
    {
        $user = User::where('email', 'ACIJ@gmail.com')->first();

        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/programarEncuesta');
    }

    public function test_the_application_returns_a_unsuccessful_auth()
    {

        $credenciales = [
            "email" => "ACIJ@gmail.com",
            "password" => "12345678"
        ];

        $response = $this->post('/login', $credenciales);
        $response->assertRedirect("/login");
    }
}
