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
              'id'                          => '1',
              'order_status_id'              => '1',
              'order_customer_id'            => '1',
              'order_customer_delivery_id'   => '1',
              'shipping'                     => '200',
              'created_at'                   =>  NOW(),
          ),

          1 =>
          array (
              'id'                           => '2',
              'order_status_id'              => '2',
              'order_customer_id'            => '2',
              'order_customer_delivery_id'   => '2',
              'shipping'                     => '15',
              'created_at'                   => NOW(),
          ),
      ));

      \DB::table('mc_orders_products')->insert(array (
          0 =>
          array (
              'id'          => '1',
              'order_id'    => '1',
              'product_id'  => '1',
              'qty'         => '2'
          ),
          1 =>
          array (
              'id'          => '2',
              'order_id'    => '1',
              'product_id'  => '2',
              'qty'         => '3'
          ),

          2 =>
          array (
              'id'          => '3',
              'order_id'    => '2',
              'product_id'  => '2',
              'qty'         => '1'
          ),
      ));
    }
}
