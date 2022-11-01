<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeddingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wedding_statuses')->insert([
            [
                'name' => 'MENIKAH',
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            ],
            [
                'name' => 'BELUM MENIKAH',
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            ],
            [
                'name' => 'CERAI HIDUP',
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            ],
            [
                'name' => 'CERAI MATI',
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            ],
        ]);
    }
}
