<?php
use KasperKloster\MonkCommerce\Models\MonkCommerceShop;


function showPrice($price)
{
  $currency = MonkCommerceShop::select('shopCurrency')->first();

  if($price != NULL)
  {
    return $price . ' ' . $currency->shopCurrency;
  }
}
