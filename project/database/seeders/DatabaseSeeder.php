<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'fio' => 'Клиент',
            'email' => 'user@flight.ru',
            'password' => 'password',
            'role' => 'user',
        ]);
        User::factory()->create([
            'fio' => 'Администратор',
            'email' => 'admin@flight.ru',
            'password' => 'QWEasd123',
            'role' => 'admin',
        ]);
    }
}
