<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUserRegistration()
    {
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'User registered successfully'
            ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com'
        ]);
    }

    public function testUserUpdate()
    {
        $user = User::factory()->create();

        $response = $this->put('/users/'.$user->id, [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'User updated successfully'
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com'
        ]);
    }

    public function testUserDeletion()
    {
        $user = User::factory()->create();

        $response = $this->delete('/users/'.$user->id);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'User deleted successfully'
            ]);

        $this->assertDeleted('users', [
            'id' => $user->id,
        ]);
    }

    public function testUserRetrieval()
    {
        $user = User::factory()->create();

        $response = $this->get('/users/'.$user->id);

        $response->assertStatus(200)
            ->assertJson([
                'users' => [
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ]);
    }

    public function testUserListRetrieval()
    {
        $users = User::factory()->count(3)->create();

        $response = $this->get('/users');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'users')
            ->assertJsonStructure([
                'users' => [
                    '*' => [
                        'name',
                        'email',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }
}
