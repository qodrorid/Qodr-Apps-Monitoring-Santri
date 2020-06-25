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
                'role_id'           => 1,
                'branch_id'         => null
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'admin',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 2,
                'branch_id'         => null
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'ketua',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 3,
                'branch_id'         => 1
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'sekretaris',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 4,
                'branch_id'         => 1
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'bendahara',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 5,
                'branch_id'         => 1
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'divisiit',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 6,
                'branch_id'         => 1
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'divisiagama',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 7,
                'branch_id'         => 1
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'mitra',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 8,
                'branch_id'         => 1
            ],
            [
                'name'              => 'Jhon Doe',
                'username'          => 'santri',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 9,
                'branch_id'         => 1
            ],
            [
                'name'              => 'Budi',
                'username'          => 'budianto',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 9,
                'branch_id'         => 1
            ],
            [
                'name'              => 'Hendy Saputra',
                'username'          => 'hendy',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 9,
                'branch_id'         => 1
            ],
            [
                'name'              => 'Asmawi Lubis',
                'username'          => 'asmawi',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 9,
                'branch_id'         => 1
            ],
            [
                'name'              => 'Agus Pratama',
                'username'          => 'agus',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 9,
                'branch_id'         => 1
            ],
            [
                'name'              => 'Alifia',
                'username'          => 'alif',
                'email'             => Str::random(12) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('bismillah'),
                'role_id'           => 9,
                'branch_id'         => 1
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
            ],
            [
                'user_id' => 10,
                'name'    => 'Budi'
            ],
            [
                'user_id' => 11,
                'name'    => 'Hendy Saputra'
            ],
            [
                'user_id' => 12,
                'name'    => 'Asmawi Lubis'
            ],
            [
                'user_id' => 13,
                'name'    => 'Agus Pratama'
            ],
            [
                'user_id' => 14,
                'name'    => 'Alifia'
            ]
        ]);

        // ====== Wakatime Url Santri ======
        DB::table('wakatime_urls')->insert([
            [
                'user_id' => 9,
                'coding_activity' => 'https://wakatime.com/share/@theger09/79cb0cfb-8f7e-4644-8be5-b68a484abfb3.json',
                'languages' => 'https://wakatime.com/share/@theger09/4e688423-496f-4c77-8d6f-aaf38b8e2b28.json',
                'editors' => 'https://wakatime.com/share/@theger09/1f06ea3e-8ff3-4e72-b7bd-dd8353ed9291.json',
                'status' => true
            ]
        ]);
    }
}
