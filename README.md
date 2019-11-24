# A Laravel Basic E-Commerce Package (WIP)

## Installation
- Install a new laravel project.
- Run composer require kasperkloster/monkcommerce.
- Go to config/app.php > providers, add: KasperKloster\MonkCommerce\Providers\MonkCommerceServiceProvider::class,
- Run php artisan vendor:publish --tag=monkcommerce
- Update seeder and run php artisan db:seed

## Views
Storefront views will be located in /resources/views/monkcommerce-storefront/.

## Setup Payment
MonkCommerce uses the Stripe API.
Insert your Stripe Secret API Key at Dashboard -> Shop Settings -> Stripe API Key
