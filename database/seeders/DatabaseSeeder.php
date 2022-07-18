<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        
        DB::table('users')->insert([
            'name_admin' => 'Alfredo Alvarez Haro',
            'email' => 'AAlvarez@gmail.com',
            'password' => bcrypt('CIJAAH1234')
        ]);

        DB::table('users')->insert([
            'name_admin' => 'Pedro Rodriguez de la Torre',
            'email' => 'PRodriguez@gmail.com',
            'password' => bcrypt('CIJPRT5678')
        ]);
        
        DB::table('users')->insert([
            'name_admin' => 'Asistente CIJ',
            'email' => 'ACIJ@gmail.com',
            'password' => bcrypt('ACIJ678')
        ]);
    }
}
