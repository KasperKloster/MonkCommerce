<?php

use Illuminate\Database\Seeder;

class MonkcommerceOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Category Products
      \DB::table('mc_orders')->insert(array (
          0 =>
          array (
              'id'        => '1',
          ),
      ));

      \DB::table('mc_orders_products')->insert(array (
          0 =>
          array (
              'id'          => '1',
              'order_id'    => '1',
              'product_id'  => '1',
          ),
      ));
    }
}
