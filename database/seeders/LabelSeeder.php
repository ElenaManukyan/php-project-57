<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Label;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labels = [
            [
                'id' => 1,
                'name' => 'ошибка',
                'description' => 'Какая-то ошибка в коде или проблема с функциональностью',
            ],
            [
                'id' => 2,
                'name' => 'документация',
                'description' => 'Задача которая касается документации',
            ],
            [
                'id' => 3,
                'name' => 'дубликат',
                'description' => 'Повтор другой задачи',
            ],
            [
                'id' => 4,
                'name' => 'доработка',
                'description' => 'Новая фича, которую нужно запилить',
            ],
        ];

        foreach ($labels as $label) {
            Label::updateOrCreate(['id' => $label['id']], $label);
        }
    }
}
