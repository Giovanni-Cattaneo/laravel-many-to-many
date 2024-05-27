<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type_names = ['front-end', 'back-end', 'full-stack', 'test'];

        foreach ($type_names as $name) {
            $type = new Type();
            $type->category = $name;
            $type->slug = Str::of($type->title)->slug('-');
            $type->save();
        }
    }
}
