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
      // Categories
      \DB::table('monkcommerce_product_categories')->insert(array (
          0 =>
          array (
              'name'         => 'Main Category',
              'slug'         => 'main-category',
              'description'  => 'Main Category. This will be shown in the menu',
              'show_in_menu' => TRUE,
              'category_id'  => NULL,
          ),

          1 =>
          array (
              'name'         => 'Main Category with subcategories',
              'slug'         => 'main-category-with-subcategories',
              'description'  => 'Main category with subcategories',
              'show_in_menu' => TRUE,
              'category_id'  => NULL,
          ),

          2 =>
          array (
              'name'         => 'Subcategory',
              'slug'         => 'subcategory',
              'description'  => 'subcategory',
              'show_in_menu' => TRUE,
              'category_id'  => 1,
          ),

          3 =>
          array (
              'name'         => 'Sub Subcategory',
              'slug'         => 'sub-subcategory',
              'description'  => 'sub subcategory',
              'show_in_menu' => TRUE,
              'category_id'  => 2,
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
