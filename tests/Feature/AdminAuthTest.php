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

    #[Test]
    public function admin_can_login(): void
    {
        $user = User::create([
            'name' => 'Administrador',
            'username' => 'admin',
            'password' => 'admin'
        ]);

        $res = $this->post('/login', [
            'username' => $user->username,
            'password' => 'admin'
        ]);

        $res->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }
}
