<?php

use Illuminate\Database\Seeder;

class McCategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $faker = \Faker\Factory::create();
      for($i=0; $i<=20; $i++):
        DB::table('mc_category_product')
            ->insert([
              'category_id'   => rand(1, 2),
              'product_id'    => rand(0, 25),
            ]);
      endfor;


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
