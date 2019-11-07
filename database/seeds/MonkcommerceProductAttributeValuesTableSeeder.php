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
      \DB::table('mc_prod_attr_values')->insert(array (
          // Create size attribute values
          0 =>
          array (
            'value'             =>  'small',
          ),
          1 =>
          array (
            'value'             =>  'medium',
          ),
          2 =>
          array (
            'value'             =>  'large',
          ),
          // Create Color attribute values
          3 =>
          array (
            'value'             =>  'black',
          ),
          4 =>
          array (
            'value'             =>  'white',
          ),
          5 =>
          array (
            'value'             =>  'red',
          ),
      ));
    }
}
