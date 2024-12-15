<?php

namespace Tests\Feature\Catigory;

use App\Traits\LoginTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CatigoryShowPageTest extends TestCase
{
    use LoginTrait;
    
    
    public function test_show_all_catigories(): void
    {
        $this->login();
        $response = $this->get('/catigory');

        $response->assertStatus(200);
    }
}
