<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = \App\Models\Company::where('name', 'Beispiel GmbH')->firstOrFail();

        $user = \App\Models\User::firstOrCreate(
            ['email' => 'entwickler@example.com'],
            [
                'name' => 'Max Mustermaxe',
                'password' => 'password0815',
            ]
        );

        $user->companies()->syncWithoutDetaching([$company->id]);
    }
}
