<?php

use Illuminate\Database\Seeder;

class McShipmentCouriersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Category Products
      \DB::table('mc_ship_couriers')->insert(array (
          0 =>
          array (
              'name'    => 'GLS',
          ),
      ));
    }
}
