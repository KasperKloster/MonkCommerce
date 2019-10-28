<?php

use Illuminate\Database\Seeder;

class MonkcommerceProductAttributeValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //
      \DB::table('monkcommerce_product_attribute_values')->insert(array (
          // Create size attribute values
          0 =>
          array (
            'attribute_id'      =>  1,
            'value'             =>  'small',
            'price'             =>  null,
          ),
          1 =>
          array (
            'attribute_id'      =>  1,
            'value'             =>  'medium',
            'price'             =>  null,
          ),
          2 =>
          array (
            'attribute_id'      =>  1,
            'value'             =>  'large',
            'price'             =>  null,
          ),
          // Create Color attribute values
          3 =>
          array (
            'attribute_id'      =>  2,
            'value'             =>  'black',
            'price'             =>  null,
          ),
          4 =>
          array (
            'attribute_id'      =>  2,
            'value'             =>  'blue',
            'price'             =>  null,
          ),
          5 =>
          array (
            'attribute_id'      =>  2,
            'value'             =>  'red',
            'price'             =>  null,
          ),
          6 =>
          array (
            'attribute_id'      =>  2,
            'value'             =>  'orange',
            'price'             =>  null,
          ),
      ));
    }
}
