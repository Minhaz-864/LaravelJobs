<?php

namespace Database\Seeders;

use App\Models\Listings;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Applicant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\User::factory(10)->create();
        $user = User::factory()->create([
            "name"=>"Tamanna",
            "email"=>"tamanna@email.com",
            "is_company"=>true,
            "password" => bcrypt('147258369')
        ]);
        
        Listings::factory(10)->create(
            [
                "user_id"=>$user->id
            ]
        );

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
