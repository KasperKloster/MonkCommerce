<?php

use Illuminate\Database\Seeder;

class MonkcommerceProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Products
      \DB::table('mc_products')->insert(array (
          0 =>
          array (
              'sku'           => 'AB00-00',
              'name'          => 'Product Name',
              'slug'          => 'product-name',
              'description'   => 'A Product Description',
              'price'         => '249',
              'special_price' => '199',
              'qty'           => '2',
              'in_stock'      => TRUE,
          ),
      ));
    }
}
