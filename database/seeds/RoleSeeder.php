<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Super Admin'
            ],
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'Ketua'
            ],
            [
                'name' => 'Sekretaris'
            ],
            [
                'name' => 'Bendahara'
            ],
            [
                'name' => 'Divisi IT'
            ],
            [
                'name' => 'Divisi Agama'
            ],
            [
                'name' => 'Mitra'
            ],
            [
                'name' => 'Santri'
            ]
        ]);
    }
}
