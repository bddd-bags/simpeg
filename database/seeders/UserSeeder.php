<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                "name" => "Administrator",
                "email" => "admin@gmail.com",
                "password" => bcrypt("admin123"),
                "role_id" => 1,
                "created_at" => new \DateTime(),
                "updated_at" => new \DateTime(),
            ],
            [
                "name" => "Pegawai",
                "email" => "pegawai@gmail.com",
                "password" => bcrypt("pegawai123"),
                "role_id" => 2,
                "created_at" => new \DateTime(),
                "updated_at" => new \DateTime(),
            ]
        ]);
    }
}
