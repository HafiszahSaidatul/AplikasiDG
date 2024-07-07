<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Item;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        User::create([
            "username" => 'admin',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'admin'
        ]);


        User::create([
            "username" => 'pegawai',
            'name' => 'pegawai',
            'email' => 'pegawai@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'pegawai'
        ]);
    }
}
