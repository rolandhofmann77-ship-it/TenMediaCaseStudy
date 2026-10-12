<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = \App\Models\Company::where('name', 'Beispiel GmbH')->firstOrFail();

        $user = \App\Models\User::where('email', 'entwickler@example.com')->firstOrFail();

        \App\Models\Job::firstOrCreate(
            [
                'company_id' => $company->id,
                'user_id' => $user->id,
                'title' => 'Junior PHP Developer',
            ],
            [
                'description' => 'Unterstütze unser Team bei der Entwicklung von Webanwendungen mit PHP und Laravel.',
                'location' => 'Berlin, Deutschland',
                'employment_type' => 'Vollzeit',
                'salary' => 43000.00,
                'currency' => 'EUR',
            ]
        );
    }
}
