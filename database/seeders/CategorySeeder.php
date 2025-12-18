<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Musik','Hiburan','Konferensi','Olahraga','Seni',
            'Workshop','Kuliner','Bisnis'
        ];

        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }
    }
}
