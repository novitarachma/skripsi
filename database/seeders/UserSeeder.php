<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('qweasdzxc'),
                'jabatan_id' => '1',

                'name' => 'karyawan',
                'email' => 'karyawan@mail.com',
                'password' => Hash::make('vita'),
                'jabatan_id' => '5',
            ],

        ];
        User::insert($users);
    }
}

