<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $user = \App\Models\User::factory(10)->create();
       $role= \App\Models\Role::factory(10)->create();
        // $this->call(RolesTableSeeder::class);
            
       

// Get all the roles attaching up to 3 random roles to each user
$roles =  \App\Models\Role::all();

// Populate the pivot table
\App\Models\User::all()->each(function ($user) use ($roles) { 
    $user->roles()->attach(
        $roles->random(rand(1, 3))->pluck('id')->toArray()
    ); 
});
           
      

        
    } //end function
}
