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
        // Crea un usuario de prueba usando el factory
        $user = User::factory()->create();

        // Simula que el usuario está autenticado para esta solicitud
        $response = $this->actingAs($user)->get('/');

        // Verifica que la respuesta sea exitosa
        $response->assertStatus(200);
    }
}
