<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CatigorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testData = [
            [
                'catigory_id'       =>  Str::random(10),
                'catigory_name'     =>  'work',
                'color'             =>  '#6B6B6B',
                'user_id'           =>  'User',
                'created_at'        =>  date('Y-m-d'),
                'updated_at'        =>  date('Y-m-d'),
            ],
            [
                'catigory_id'       =>  Str::random(10),
                'catigory_name'     =>  'personal',
                'color'             =>  '#4C1F1F',
                'user_id'           =>  'User',
                'created_at'        =>  date('Y-m-d'),
                'updated_at'        =>  date('Y-m-d'),
            ],
            [
                'catigory_id'       =>  Str::random(10),
                'catigory_name'     =>  'urgent',
                'color'             =>  '#CC0000',
                'user_id'           =>  'User',
                'created_at'        =>  date('Y-m-d'),
                'updated_at'        =>  date('Y-m-d'),
            ],
        ];
        \App\Models\Catigory::select()->forceDelete();
        \App\Models\Catigory::insert($testData);
    }
}
