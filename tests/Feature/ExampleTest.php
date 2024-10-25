<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $user = User::factory()->create([
            'username' => 'dr.jasen', // Agrega el campo 'username' con un valor
        ]);
    
        $this->actingAs($user);
    
        $response = $this->get('/');
    
        $response->assertStatus(200);
    }
}
