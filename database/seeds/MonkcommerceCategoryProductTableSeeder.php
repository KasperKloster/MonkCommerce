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
      \DB::table('monkcommerce_category_product')->insert(array (
          0 =>
          array (
              'id'            => '1',
              'category_id'   => '1',
              'product_id'    => '1',
          ),
          1 =>
          array (
              'id'            => '2',
              'category_id'   => '2',
              'product_id'    => '1',
          ),
      ));
    }
}
