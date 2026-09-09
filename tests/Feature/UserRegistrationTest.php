<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_is_registered(): void {
        $this->registerUser();
        $this->assertModelExists($this->findUser());
    }

    #[Test]
    public function registration_redirects_to_login(): void {
        $res = $this->registerUser();
        $res->assertRedirect('/login');
    }

    #[Test]
    public function created_user_can_login(): void {
        $this->registerUser();
        $user = $this->findUser();

        $this->post('/login', [
            'username' => $user->username,
            'password' => 'senha'
        ]);

        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function created_user_cant_access_admin_panel(): void {
        $this->registerUser();
        $user = $this->findUser();

        $this->post('/login', [
            'username' => $user->username,
            'password' => 'senha'
        ]);

        $res = $this->get('/admin');

        $res->assertForbidden();
        $this->assertAuthenticatedAs($user);
    }

    protected function registerUser(): TestResponse {
        return $this->post('/register', [
            'name' => 'Teste Gamer',
            'username' => 'testegamer123',
            'email' => 'teste.gamer123@email.com',
            'password' => 'senha'
        ]);
    }

    protected function findUser(): User {
        return User::firstWhere('email', 'teste.gamer123@email.com');
    }
}
