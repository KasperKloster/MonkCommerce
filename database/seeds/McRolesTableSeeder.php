<?php

use Illuminate\Database\Seeder;

class McRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('mc_roles')->insert(array (
        0 =>
        array (
            'id'            => '1',
            'role'          => 'admin',
        ),
        1 =>
        array (
            'id'            => '2',
            'role'          => 'customer',
        ),
      ));
    }
}
