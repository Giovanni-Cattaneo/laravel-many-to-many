<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->title = $faker->words(4, true);
            $project->cover_image = $faker->imageUrl(600, 300, 'Projects', true, $project->title, true, 'jpg');
            $project->slug = Str::of($project->title)->slug('-');
            $project->description = $faker->text(450);
            $project->save();
        }
    }
}
