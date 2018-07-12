<?php

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $foodTag = \App\Models\Tag::create([
            'name' => 'food'
        ]);

        $clothesTag = \App\Models\Tag::create([
            'name' => 'clothes'
        ]);

        $transportTag = \App\Models\Tag::create([
            'name' => 'transport'
        ]);

        $entertainmentTag =\App\Models\Tag::create([
            'name' => 'entertainment'
        ]);

        $healthTag = \App\Models\Tag::create([
            'name' => 'health'
        ]);

        $educationTag = \App\Models\Tag::create([
            'name' => 'education'
        ]);

        $animalTag = \App\Models\Tag::create([
            'name' => 'animal'
        ]);

        $communicationTag = \App\Models\Tag::create([
            'name' => 'communication'
        ]);

        $houseTag = \App\Models\Tag::create([
            'name' => 'house'
        ]);

        $otherTag = \App\Models\Tag::create([
            'name' => 'other'
        ]);
    }
}
