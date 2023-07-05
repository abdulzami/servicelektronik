<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'nama' => 'Pak Admin',
                'username' => 'admin123',
                'password' => bcrypt('admin123'),
                'level' => 'admin'
            ],
            [
                'nama' => 'Konsumen123',
                'jk' => 'L',
                'alamat' => 'Jalan jalan',
                'no_hp' => '081331722530',
                'username' => 'konsumen123',
                'password' => bcrypt('konsumen123'),
                'level' => 'konsumen'
            ],
            // ,
            // [
            //     'username' => 'kasirprint',
            //     'name' => 'Kasir Usaha Print',
            //     'level' => 'kasir',
            //     'password' => bcrypt('kasirprint123'),
            //     'wujud_usaha' => 'produk'
            // ],
            // [
            //     'username' => 'kasirgalon',
            //     'name' => 'Kasir Usaha Isi Ulang Galon',
            //     'level' => 'kasir',
            //     'password' => bcrypt('kasirgalon123'),
            //     'wujud_usaha' => 'produk'
            // ],
        ];
        foreach ($user as $key => $value){
            User::create($value);
        }
    }
}

