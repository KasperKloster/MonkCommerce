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

function badgeStatus($statusCode)
{
  /*
  * Status Codes:
  * 1: New
  * 2: Pending
  * 3: Declined
  * 4: Sent
  */
  if ($statusCode == '1')
  {
    $return = 'badge-success';
  }
  elseif ($statusCode == '2')
  {
    $return = 'badge-warning';
  }
  elseif ($statusCode == '3')
  {
    $return = 'badge-danger';
  }
  elseif ($statusCode == '4')
  {
    $return = 'badge-primary';
  }

  return $return;
}
