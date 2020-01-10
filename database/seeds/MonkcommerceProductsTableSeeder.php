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
            'weight'        => '1000',
            'qty'           => '2',
        ),
        1 =>
        array (
            'sku'           => 'AB00-01',
            'name'          => 'Product Name 1',
            'slug'          => 'product-name-1',
            'description'   => 'A Product Description',
            'price'         => '100',
            'special_price' => '50',
            'weight'        => '2000',
            'qty'           => '20',
        ),
        2 =>
        array (
            'sku'           => 'ABC10-00',
            'name'          => 'Product Name 2',
            'slug'          => 'product-name-2',
            'description'   => 'A Product Description',
            'price'         => '1500',
            'special_price' => '900',
            'weight'        => '100',
            'qty'           => '2',
        ),
        3 =>
        array (
            'sku'           => 'ABC20-00',
            'name'          => 'Product Name 3',
            'slug'          => 'product-name-3',
            'description'   => 'A Product Description',
            'price'         => '249',
            'special_price' => NULL,
            'weight'        => '8000',
            'qty'           => '0',
        ),
      ));
      // Main Product Images
      \DB::table('mc_prod_images')->insert(array (
        0 =>
        array (
          'product_id'  => 1,
          'filename'    => '/default.jpg',
          'main'        => TRUE,
        ),
        1 =>
        array (
          'product_id'  => 2,
          'filename'    => '/default.jpg',
          'main'        => TRUE,
        ),
        2 =>
        array (
          'product_id'  => 3,
          'filename'    => '/default.jpg',
          'main'        => TRUE,
        ),
        3 =>
        array (
          'product_id'  => 4,
          'filename'    => '/default.jpg',
          'main'        => TRUE,
        ),

        4 =>
        array (
          'product_id'  => 1,
          'filename'    => '/default.jpg',
          'main'        => FALSE,
        ),
      ));
    }
}
