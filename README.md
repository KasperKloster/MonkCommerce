# A Laravel Basic E-Commerce Package (WIP)

## Installation
- Install a new laravel project.
- Install laravel/ui and run php artisan ui vue --auth
- Run composer require kasperkloster/monkcommerce.
- Go to config/app.php > providers, add: KasperKloster\MonkCommerce\Providers\MonkCommerceServiceProvider::class,
- Run php artisan vendor:publish --tag=monkcommerce
- Update seeder and run php artisan db:seed
- Register admin middleware under app/kernel, routeMiddleware, ```'admin' => \KasperKloster\MonkCommerce\Middleware\AdminMiddleware::class,```

## Views
Storefront views will be located in /resources/views/monkcommerce-storefront/.


## Seeder
Paste in DatabaseSeeder.php
```
$this->call(MonkCommerceProductCategoriesTableSeeder::class);
$this->call(MonkcommerceProductsTableSeeder::class);
$this->call(MonkcommerceCategoryProductTableSeeder::class);
$this->call(MonkCommerceStaticPagesSeeder::class);
$this->call(MonkcommerceProductAttributesTableSeeder::class);
$this->call(MonkcommerceProductAttributeValuesTableSeeder::class);
$this->call(MonkCommerceProductAttrProductAttrValueTableSeeder::class);
$this->call(MonkcommerceShipmentCouriersTableSeeder::class);
$this->call(MonkcommerceOrdersStatusSeeder::class);
$this->call(MonkCommerceOrdersCustomerSeeder::class);
$this->call(MonkcommerceOrdersTableSeeder::class);
```
