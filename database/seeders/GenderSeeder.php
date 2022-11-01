<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->insert([
            [
                'name' => 'LAKI-LAKI',
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            ],
            [
                'name' => 'PEREMPUAN',
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            ]
        ]);
    }
}
