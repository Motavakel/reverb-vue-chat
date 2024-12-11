<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{

    public function run(): void
    {
       Message::factory()
       ->count(500)
       ->sequence(function(Sequence $sequence){
            return [
                'content' => 'پیام شماره ' . $sequence->index,
                'created_at' => now()->subYear()->addHours($sequence->index),
                'user_id' => rand(2,1)
            ];
       })
       ->create([
        'room_id' => 1
       ]);
    }
}
