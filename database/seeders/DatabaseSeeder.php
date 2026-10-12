<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents; //disable model events during seeding to prevent unwanted side effects

    //Seed the application's database in the correct order.
    public function run(): void
    {
        $this->call([
            CompanySeeder::class,
            UserSeeder::class,
            JobSeeder::class,
        ]);
    }
}
