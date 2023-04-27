<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test untuk menampilkan daftar user
     */
    public function testIndex()
    {
        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertViewIs('loaduser');
        $response->assertViewHas('users');
    }

    /**
     * Test untuk menampilkan detail user
     */
    public function testShow()
    {
        $user = User::factory()->create()->first();

        $response = $this->get('/users/' . $user->id);

        $response->assertStatus(200);
        $response->assertJson([
            'users' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    /**
     * Test untuk menampilkan halaman tambah user
     */
    public function testShowAdd()
    {
        $response = $this->get('/users/add');

        $response->assertStatus(200);
        $response->assertViewIs('adduser');
    }

    /**
     * Test untuk menyimpan data user baru
     */
    public function testStore()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/users/add', $data);

        $response->assertRedirect('/users');
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ]);
    }

    /**
     * Test untuk menampilkan halaman update user
     */
    public function testShowUpdate()
    {
        $user = User::factory()->create()->first();

        $response = $this->get('/users/' . 'edit/' . $user->id);

        $response->assertStatus(200);
        $response->assertViewIs('updateuser');
        $response->assertViewHas('user', $user);
    }

    /**
     * Test untuk mengupdate data user
     */
    public function testUpdate()
    {
        $user = User::factory()->create()->first();

        $data = [
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
        ];

        $response = $this->put('/users/' . $user->id, $data);

        $response->assertRedirect('/users');
        $this->assertDatabaseHas('users', [
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
        ]);
    }

    /**
     * Test untuk menghapus user
     */
    public function testDestroy()
    {
        $user = User::factory()->create()->first();

        $response = $this->delete('/users/' . $user->id);

        $response->assertRedirect('/users');
        $this->assertDeleted($user);
    }
}
