<?php

use Illuminate\Database\Seeder;

class MonkcommerceOrdersStatusSeeder extends Seeder
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
              'status'    => 'Declined',
          ),
          3 =>
          array (
              'status'    => 'Sent',
          ),
      ));
    }
}
