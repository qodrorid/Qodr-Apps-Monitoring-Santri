<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ====== Users ======
        DB::table('users')->insert([
            [
                'name'              => 'Jhon Doe',
                'username'          => 'root',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 1
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'admin',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 2
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'ketua',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 3
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'sekretaris',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 4
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'bendahara',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 5
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'divisiit',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 6
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'divisiagama',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 7
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'mitra',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 8
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'santri',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 9
            ]
        ]);

        // ====== Profile Pengurus ======
        DB::table('profile_penguruses')->insert([
            [
                'user_id' => 2,
                'name'    => 'Jhon Doe'
            ],
            [
                'user_id' => 3,
                'name'    => 'Jhon Doe'
            ],
            [
                'user_id' => 4,
                'name'    => 'Jhon Doe'
            ],
            [
                'user_id' => 5,
                'name'    => 'Jhon Doe'
            ],
            [
                'user_id' => 6,
                'name'    => 'Jhon Doe'
            ],
            [
                'user_id' => 7,
                'name'    => 'Jhon Doe'
            ]
        ]);

        // ====== Profile Mitra ======
        DB::table('profile_mitras')->insert([
            [
                'user_id' => 8,
                'name'    => 'Jhon Doe'
            ]
        ]);

        // ====== Profile Santri ======
        DB::table('profile_santris')->insert([
            [
                'user_id' => 9,
                'name'    => 'Jhon Doe'
            ]
        ]);
    }
}
