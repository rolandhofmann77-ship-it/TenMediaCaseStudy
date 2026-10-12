<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Company::firstOrCreate(
            ['name' => 'Beispiel GmbH'],
            [
                'description' => 'Ein fiktives Unternehmen für Beispieldaten.',
                'website' => 'https://www.beispiel-gmbh.de',
                'email' => 'kontakt@beispiel-gmbh.de',
                'phone' => '+49 30 1234567',
                'address' => 'Beispielstraße 1, 12345 Berlin, Deutschland',
            ]
        );
    }
}
