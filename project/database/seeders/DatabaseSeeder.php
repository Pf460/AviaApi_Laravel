<?php

namespace Database\Seeders;

use App\Models\Product;
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

        Product::factory()->create([
            'name' => 'SU-100 Москва - Сочи',
            'description' => 'Рейс SU-100, Вылет 12:00, Эконом класс',
            'price' => 8500
        ]);
        Product::factory()->create([
            'name' => 'SU-200 Москва - Санкт-Петербург',
            'description' => 'Рейс SU-200, Вылет 13:00, Эконом класс',
            'price' => 10500
        ]);
        Product::factory()->create([
            'name' => 'SU-300 Москва - Сочи',
            'description' => 'Рейс SU-300, Вылет 10:00, Бизнес класс',
            'price' => 15500.50
        ]);
    }
}
