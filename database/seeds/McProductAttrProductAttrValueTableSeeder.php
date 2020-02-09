<?php

use Illuminate\Database\Seeder;

class McProductAttrProductAttrValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //
      \DB::table('mc_prod_attr_prod_values')->insert(array (
          0 =>
          array (
            'product_attribute_id'       => '1',
            'product_attribute_value_id' => '1',
          ),
          1 =>
          array (
            'product_attribute_id'       => '1',
            'product_attribute_value_id' => '2',
          ),
          2 =>
          array (
            'product_attribute_id'       => '1',
            'product_attribute_value_id' => '3',
          ),
          3 =>
          array (
            'product_attribute_id'       => '2',
            'product_attribute_value_id' => '4',
          ),
          4 =>
          array (
            'product_attribute_id'       => '2',
            'product_attribute_value_id' => '5',
          ),
          5 =>
          array (
            'product_attribute_id'       => '2',
            'product_attribute_value_id' => '6',
          ),
      ));
    }
}
