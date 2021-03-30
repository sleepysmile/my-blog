<?php

namespace Database\Seeders;

use App\Models\Publication;
use App\Models\Tags;
use Illuminate\Database\Seeder;

class PublicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Publication::factory()
            ->count(400)
            ->has(Tags::factory()
                ->count(5),
                'tags'
            )
            ->create();
    }
}
