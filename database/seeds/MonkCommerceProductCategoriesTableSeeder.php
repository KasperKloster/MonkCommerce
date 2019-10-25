<?php

use Illuminate\Database\Seeder;

class MonkCommerceProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Main Categories
      \DB::table('monkcommerce_product_categories')->insert(array (
          0 =>
          array (
              'name'         => 'Visible Main Category',
              'slug'         => 'visible-main-category',
              'description'  => 'A Description of Main Category. This will be shown in the menu',
              'show_in_menu' => TRUE,
          ),

          1 =>
          array (
              'name'         => 'Non-visible Category',
              'slug'         => 'non-visible-main-category',
              'description'  => 'A Description of Main Category that will not be shown in the menu.',
              'show_in_menu' => NULL,
          )
      ));

      // Subcategories
      \DB::table('monkcommerce_product_subcategories')->insert(array (
          0 =>
          array (
              'name'                => 'A Name of Subcategory',
              'slug'                => 'a-name-of-subcategory',
              'description'         => 'A Description of a Subcategory Description',
              'product_category_id' => '1',
              'show_in_menu'        => TRUE,
          ),
      ));

      // Products
      \DB::table('monkcommerce_products')->insert(array (
          0 =>
          array (
              'sku'           => 'AB00-00',
              'name'          => 'Product Name',
              'slug'          => 'product-name',
              'description'   => 'A Product Description',
              'price'         => '249',
              'special_price' => '199',
              'qty'           => '2',
              'in_stock'      => TRUE,
          ),
      ));

    }
}
