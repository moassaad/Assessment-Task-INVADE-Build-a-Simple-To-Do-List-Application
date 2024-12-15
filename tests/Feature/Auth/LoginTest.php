<?php

namespace Tests\Feature\Auth;

use App\Traits\LoginTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use LoginTrait;
    /**
     * A basic feature test example.
     */
    public function test_show_login_page(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_show_home_page(): void
    {
        $this->login();
        $response = $this->get('/home');

        $response->assertStatus(200);
    }

    public function test_login(): void
    {
        $response = $this->withSession(['_token'=>'token'])
            ->post('/', ['email'=>'max@mail.com','password'=>'password', '_token'=>'token']);
        
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }    public function test_login_error_data()
    {
        $response = $this->withSession(['_token'=>'token'])
            ->post('/', ['email'=>'min@mail.com','password'=>'password1','_token'=>'token']);
        
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }
    public function test_login_null_data()
    {
        $response = $this->withSession(['_token'=>'token'])
            ->post('/', ['email'=>'', 'password'=>'', '_token'=>'token']);
        
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }
}
