<?php

namespace Tests\Feature\Task;

use App\Models\Catigory;
use App\Traits\LoginTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskShowPageTest extends TestCase
{
    use LoginTrait;
    
    
    public function test_show_all_tasks(): void
    {
        $this->login();
        $response = $this->get('/task');

        $response->assertStatus(200);
    }
    public function test_show_today_tasks(): void
    {
        $this->login();
        $response = $this->get('/task/today');

        $response->assertStatus(200);
    }
    public function test_show_filter_tasks_with_catigory(): void
    {
        $this->login();
        $catigory = Catigory::where(['user_id'=>auth()->user()->user_id])->first();
        $response = $this->get("/task/filter/catigory/{$catigory->catigory_id}");

        $response->assertStatus(200);
    }
    public function test_show_filter_tasks_with_completion(): void
    {
        $this->login();
        $status = ['completed','pending'];
        $response = $this->get("/task/filter/completion/{$status[rand(0,1)]}");

        $response->assertStatus(200);
    }
}
