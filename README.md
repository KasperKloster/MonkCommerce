# A Laravel Basic E-Commerce Package (WIP)

## Installation
- Install a new laravel project.
- Run composer require kasperkloster/monkcommerce.
- Go to config/app.php > providers, add: KasperKloster\MonkCommerce\Providers\MonkCommerceServiceProvider::class,
- Run php artisan vendor:publish --tag=monkcommerce
- Update seeder and run php artisan db:seed
- Stripe.js **requires** HTTPS

## Views
Storefront views will be located in /resources/views/monkcommerce-storefront/.
