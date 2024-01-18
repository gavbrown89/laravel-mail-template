<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('memberships')->insert([
            'firstname' => 'Joe',
            'surname' => 'Bloggs',
            'date_due' => Carbon::now()
        ]);
    }
}
