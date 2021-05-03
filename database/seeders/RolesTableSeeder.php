<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Str;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $faker = Faker\Factory::create();
        DB::table('roles')->insert([
            // 'name' => Str::random(10),
            'name' => $faker->name,
            
        ]);
    }
}
