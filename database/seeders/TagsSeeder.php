<?php

namespace Database\Seeders;

use App\Models\Publication;
use App\Models\Tags;
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
        Tags::factory()
            ->count(200)
            ->has(Publication::factory()
                ->count(200),
                'publications'
            )
            ->create();
    }
}
