<?php

use Illuminate\Database\Seeder;

class MonkCommerceOrdersCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Category Products
      \DB::table('mc_orders_customers')->insert(array (
          0 =>
          array (
              'first_name'      => 'Firstname',
              'last_name'       => 'Lastname',
              'street_address'  => 'street',
              'postal_code'     => '1000',
              'city'            => 'cityname',
              'country'         => 'Denmark',
              'phone'           => '12 34 56 78',
              'email'           => 'name@example.com',
          ),
      ));
    }
}
