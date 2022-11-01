<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            [
                'user_id' => 1,
                'gender_id' => 1,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            ],
            [
                'user_id' => 2,
                'gender_id' => 1,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            ]
        ]);
    }
}
