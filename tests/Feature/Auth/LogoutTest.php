<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_logout_any_user(): void
    {
        $response = $this->get('/logout');
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }
}
