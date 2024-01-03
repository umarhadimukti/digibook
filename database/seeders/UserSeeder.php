<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@digibook.test',
            'password' => Hash::make('Admin'),
            'phone' => '089673356109',
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'Umar Hadi Mukti',
            'username' => 'umarhadimukti30',
            'email' => 'umar@digibook.test',
            'password' => Hash::make('Keroncong30'),
            'phone' => '089673356109',
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'DetikCom',
            'username' => 'detikcom_bestie',
            'email' => 'detikcom@digibook.test',
            'password' => Hash::make('detikcom'),
            'phone' => '089673356109',
            'role_id' => 1,
        ]);
    }
}
