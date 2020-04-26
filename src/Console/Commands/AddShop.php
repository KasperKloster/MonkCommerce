<?php

namespace KasperKloster\MonkCommerce\Console\Commands;

use Illuminate\Console\Command;
use DB;

class AddShop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monkcommerce:shop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Your Shop Informations';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $this->info('You can always edit this later');

      $name = $this->ask('Type in store Name');
      $street_address = $this->ask('Type in Street address');
      $postal_code = $this->ask('Type in Postal code');
      $city = $this->ask('Type in City');
      $country = $this->ask('Type in Country');
      $phone = $this->ask('Type in Phone');
      $email = $this->ask('Type in store info email');
      $url = $this->ask('Type in URL');
      $vat_number = $this->ask('Type in Vat number');
      $currency = $this->ask('Type in Currency. eg: KR or $');
      $schema_currency = $this->ask('Type in ISO 4217 currency format');
      $bambora_api = $this->ask('Type in your Bambora API Key');
      $bambora_merchant = $this->ask('Type in your Bambora merchant number. Eg: 8038586');
      $shipmondo_api = $this->ask('Type in your Shipmondo API Key');

      if ($this->confirm('Will you insert this shop?'))
      {
        DB::table('mc_shop_informations')->insert([
          [
            'name'            => $name,
            'street_address'  => $street_address,
            'postal_code'     => $postal_code,
            'city'            => $city,
            'country'         => $country,
            'phone'           => $phone,
            'email'           => $email,
            'url'             => $url,
            'vat_number'      => $vat_number,
            'currency'        => $currency,
            'schema_currency' => $schema_currency,
            'bambora_api'     => $bambora_api,
            'bambora_merchant' => $bambora_merchant,
            'shipmondo_api'   => $shipmondo_api,
          ]
        ]);

        return $this->info('Store is added');
      }
      $this->warn('No store was added');

    }
}
