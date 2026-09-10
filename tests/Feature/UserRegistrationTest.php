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
            'login-field' => $user->username,
            'password' => 'senha'
        ]);

        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function created_user_cant_access_admin_panel(): void {
        $this->registerUser();
        $user = $this->findUser();

        $this->post('/login', [
            'login-field' => $user->username,
            'password' => 'senha'
        ]);

        $res = $this->get('/admin');

        $res->assertForbidden();
        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function user_cant_register_without_password_confirmation(): void {
        $this->registerUser(false);
        $user = $this->findUser();
        $this->assertNull($user);
    }

    protected function registerUser(bool $confirmed = true): TestResponse {
        return $this->post('/register', [
            'name' => 'Teste Gamer',
            'username' => 'testegamer123',
            'email' => 'teste.gamer123@email.com',
            'password' => 'senha',
            'password_confirmation' => $confirmed ? 'senha' : ''
        ]);
    }

    protected function findUser(): ?User {
        return User::firstWhere('email', 'teste.gamer123@email.com');
    }
}
