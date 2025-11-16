<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'name'       => 'Phone-Number',
                'key'        => 'phone',
                'value'      => '+2348067780422',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Phone-Number-2',
                'key'        => 'phone2',
                'value'      => '+2349113333439',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
