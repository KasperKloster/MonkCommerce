<?php

use Illuminate\Database\Seeder;

class MonkCommerceStaticPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('mc_static_pages')->insert(array (
          0 =>
          array (
              'name'           => 'About',
              'slug'           => 'about',
              'description'    => 'about this site',
              'show_in_menu'   => TRUE,
          ),
          1 =>
          array (
              'name'           => 'Privacy and cookie policy',
              'slug'           => 'privacy-and-cookie-policy',
              'description'    => 'Privacy and cookie policy',
              'show_in_menu'   => TRUE,
          ),
      ));
    }
}
