<?php

use Illuminate\Database\Seeder;

class McOrdersStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Category Products
      \DB::table('mc_orders_status')->insert(array (
          0 =>
          array (
              'status'   => 'New',
          ),
          1 =>
          array (
              'status'   => 'Pending',
          ),
          2 =>
          array (
              'status'    => 'Decline',
          ),
          3 =>
          array (
              'status'    => 'Sent',
          ),
      ));
    }
}
