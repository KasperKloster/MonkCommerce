<?php

use Illuminate\Database\Seeder;

class MonkcommerceCategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Category Products
      \DB::table('mc_category_product')->insert(array (
          0 =>
          array (
              'category_id'   => '1',
              'product_id'    => '1',
          ),
          1 =>
          array (
              'category_id'   => '2',
              'product_id'    => '1',
          ),
          2 =>
          array (
              'category_id'   => '2',
              'product_id'    => '2',
          ),
          3 =>
          array (
              'category_id'   => '2',
              'product_id'    => '2',
          ),
          4 =>
          array (
              'category_id'   => '3',
              'product_id'    => '3',
          ),
      ));
    }
}
