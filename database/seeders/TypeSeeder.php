<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use App\Models\Type;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $labels = ['Frontend', 'Backend', 'UI/UX', 'FullStack', 'Design'];

        foreach ($labels as $label) 
        {
            $type = new Type();

            $type->label = $label;
            $type->slug = Str::slug($label);
            $type->color = $faker->hexColor();

            
            $type->save();
        }

    }
}
