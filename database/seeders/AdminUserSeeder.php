<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus entri duplikat jika ada
        User::where('email', 'admin@gmail.com')->delete();
        User::where('email', 'admin1@gmail.com')->delete();

        // Tambahkan entri baru
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'salah_password' => 0,
                'blokir' => 0,
            ],
            [
                'name' => 'Admin1',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('12345'),
                'salah_password' => 0,
                'blokir' => 0,
            ]
        ]);
    }
}
