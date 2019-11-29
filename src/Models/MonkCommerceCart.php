<?php

namespace KasperKloster\MonkCommerce\Models;

// use Illuminate\Database\Eloquent\Model;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttributeValue;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttribute;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductImage;

class MonkCommerceCart
{
  public $items = null;
  public $totalQty = 0;
  public $totalPrice = 0;

  public function __construct($oldCart)
  {
    if ($oldCart)
    {
      $this->items = $oldCart->items;
      $this->totalQty = $oldCart->totalQty;
      $this->totalPrice = $oldCart->totalPrice;
    }
  }

  public function add($item, $id, $quantity)
  {
    $storedItem =
    [
      'qty'   => 0,
      'price' => ($item->special_price) ? $item->special_price : $item->price,
      'item'  => $item,
      'image' => $item->images,
    ];

    if ($this->items)
    {
      if (array_key_exists($id, $this->items))
      {
        $storedItem = $this->items[$id];
      }
    }
    $storedItem['qty']++;
    $storedItem['price'] = ($item->special_price) ? $item->special_price * $storedItem['qty'] : $item->price * $storedItem['qty'];
    $this->items[$id] = $storedItem;
    $this->totalQty++;
    // Plus Shipping, Tax
    $this->totalPrice += ($item->special_price) ? $item->special_price : $item->price;

  }
}
