<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // array of email template names
        $names = [
            'subscription due',
            'subscription overdue'
        ];

        // loop through names array and insert into email_templates
        foreach ($names as $i) {
            DB::table('email_templates')->insert([
                'name' => $i
            ]);
        }
    }
}
