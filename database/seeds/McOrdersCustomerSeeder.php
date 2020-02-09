<?php

use Illuminate\Database\Seeder;

class McOrdersCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Customers Billing
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

          1 =>
          array (
              'first_name'      => 'SecondFirstname',
              'last_name'       => 'SecondLastname',
              'street_address'  => 'Secondstreet',
              'postal_code'     => '1000',
              'city'            => 'cityname',
              'country'         => 'Denmark',
              'phone'           => '12 34 56 78',
              'email'           => 'name@example.com',
          ),
      ));

      \DB::table('mc_orders_customers_delivery')->insert(array (
          0 =>
          array (
              'first_name'      => 'Delivery Firstname',
              'last_name'       => 'Delivery Lastname',
              'street_address'  => 'Delivery street',
              'postal_code'     => '2000',
              'city'            => 'Delivery cityname',
              'country'         => 'Delivery Denmark',
          ),

          1 =>
          array (
              'first_name'      => 'Second Delivery Firstname',
              'last_name'       => 'Second Delivery Lastname',
              'street_address'  => 'Second Delivery street',
              'postal_code'     => '1000',
              'city'            => 'city Delivery name',
              'country'         => 'Delivery',
          ),
      ));
    }
}
