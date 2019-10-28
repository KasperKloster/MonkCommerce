<?php

use Illuminate\Database\Seeder;

class MonkcommerceProductAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('monkcommerce_product_attributes')->insert(array (
        // Create a size attribute
        0 =>
        array (
          'name'          =>  'Size',
        ),
        // Create a color attribute
        1 =>
        array (
          'name'          =>  'Color',
        ),
        
      ));
    }
}
