# A Laravel Basic E-Commerce Package (WIP)

## Installation
- Install a new laravel project.
- Install laravel/ui and run php artisan ui vue --auth
- Run composer require kasperkloster/monkcommerce.
- Go to config/app.php > providers, add: KasperKloster\MonkCommerce\Providers\MonkCommerceServiceProvider::class,
- Run php artisan vendor:publish --tag=monkcommerce
- Update seeder and run php artisan db:seed
- Create an admin: Run ```php artisan monkcommerce:admin```
- Create shop information: Run ```php artisan monkcommerce:shop```
- Register admin middleware under app/kernel, routeMiddleware, ```'admin' => \KasperKloster\MonkCommerce\Middleware\AdminMiddleware::class,```

## Views
Storefront views will be located in /resources/views/monkcommerce-storefront/.


## Seeder
Paste in DatabaseSeeder.php
```
$this->call(McProductCategoriesTableSeeder::class);
$this->call(McProductsTableSeeder::class);
$this->call(McCategoryProductTableSeeder::class);
$this->call(McStaticPagesSeeder::class);
$this->call(McProductAttributesTableSeeder::class);
$this->call(McProductAttributeValuesTableSeeder::class);
$this->call(McProductAttrProductAttrValueTableSeeder::class);
$this->call(McShipmentCouriersTableSeeder::class);
$this->call(McOrdersStatusSeeder::class);
$this->call(McOrdersCustomerSeeder::class);
$this->call(McOrdersTableSeeder::class);
$this->call(McRolesTableSeeder::class);
```
