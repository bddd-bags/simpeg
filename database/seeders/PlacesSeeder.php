<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('places')->insert([
            [
                'name' => 'DALAM NEGERI',
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            ],
            [
                'name' => 'LUAR NEGERI',
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            ]
        ]);
    }
}
