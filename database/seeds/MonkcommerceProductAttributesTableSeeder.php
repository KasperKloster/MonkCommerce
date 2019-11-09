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
      \DB::table('mc_prod_attr')->insert(array (
        // Create a size attribute
        0 =>
        array (
          'name'          =>  'Size',
          'slug'          =>  'size',
        ),
        // Create a color attribute
        1 =>
        array (
          'name'          =>  'Color',
          'slug'          =>  'color',
        ),
      ));
    }
}
