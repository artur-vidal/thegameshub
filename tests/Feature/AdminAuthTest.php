<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    protected static $userPassword = 'senha';

    #[Test]
    public function user_can_login(): void
    {
        $user = User::factory()->create();

        $res = $this->post('/login', [
            'login-field' => $user->username,
            'password' => static::$userPassword
        ]);

        $res->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function user_can_login_with_email(): void
    {
        $user = User::factory()->create();

        $res = $this->post('/login', [
            'login-field' => $user->email,
            'password' => static::$userPassword
        ]);

        $res->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function user_cant_login_with_wrong_password(): void {
        $user = User::factory()->create();

        $res = $this->post('/login', [
            'login-field' => $user->username,
            'password' => 'senhaerrada'
        ]);

        $res->assertRedirect(); // não especifico rota pois pode voltar pra qualquer lugar
    }

    #[Test]
    public function user_can_logout(): void {
        $user = User::factory()->create();

        $this->post('/login', [
            'login-field' => $user->username,
            'password' => static::$userPassword
        ]);

        $this->assertAuthenticatedAs($user);

        $this->get('/logout');

        $this->assertGuest();
    }

    #[Test]
    public function logout_redirects_to_login_form(): void {
        $user = User::factory()->create();

        $this->post('/login', [
            'username' => $user->username,
            'password' => static::$userPassword
        ]);

        $res = $this->get('/logout');

        $res->assertRedirect('/login');
    }

    #[Test]
    public function guest_cant_access_admin_panel(): void {
        $res = $this->get('/admin');
        $res->assertForbidden();
    }

    #[Test]
    public function admin_can_access_admin_panel(): void {
        $user = User::factory()->administrator()->create();
        $user->update(['admin' => true]);

        $this->post('/login', [
            'login-field' => $user->username,
            'password' => static::$userPassword
        ]);

        $res = $this->get('/admin');
        $res->assertOk();
    }

    #[Test]
    public function common_user_cant_access_admin_panel(): void {
        $user = User::factory()->create();

        $this->post('/login', [
            'username' => $user->username,
            'password' => static::$userPassword
        ]);

        $res = $this->get('/admin');
        $res->assertForbidden();
    }
}
