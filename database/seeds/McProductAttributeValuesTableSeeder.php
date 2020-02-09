<?php

use Illuminate\Database\Seeder;

class McProductAttributeValuesTableSeeder extends Seeder
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
            'value'             =>  'Small',
          ),
          1 =>
          array (
            'value'             =>  'Medium',
          ),
          2 =>
          array (
            'value'             =>  'Large',
          ),
          // Create Color attribute values
          3 =>
          array (
            'value'             =>  'Black',
          ),
          4 =>
          array (
            'value'             =>  'White',
          ),
          5 =>
          array (
            'value'             =>  'Red',
          ),
      ));
    }
}
