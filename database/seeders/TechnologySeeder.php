<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['html', 'css', 'php', 'js', 'vue', 'laravel', 'bootstrap', 'tailwind'];

        foreach ($technologies as $tech) {
            $technology = new Technology();
            $technology->name = $tech;
            $technology->slug = Str::of($technology->name)->slug('-');
            $technology->save();
        }
    }
}
