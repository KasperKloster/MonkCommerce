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
  public $totalPrice = 0;
  public $totalQty = 0;

  // OldCart
  public function __construct($oldCart)
  {
    if ($oldCart)
    {
      $this->items      = $oldCart->items;
      $this->totalPrice = $oldCart->totalPrice;
      $this->totalQty   = $oldCart->totalQty;
    }
  }
  //
  public function add($item, $id, $productQty)
  {
    // Current Clicked Item
    $storedItem =
    [
      'qty'        => $productQty,
      'totalPrice' => ($item['special_price']) ? $item['special_price'] * $productQty : $item['price'] * $productQty,
      'item'       => $item,
    ];

    if ($this->items)
    {
      // Does the item already Exists? Update
      if (array_key_exists($id, $this->items))
      {
        $storedItem                = $this->items[$id];
        $storedItem['qty']         = $productQty;
        $storedItem['totalPrice']  = ($item['special_price']) ? $item['special_price'] * $storedItem['qty'] : $item['price'] * $storedItem['qty'];
        // Remove from totalQty and totalPrice
        $this->totalQty = $this->totalQty - $this->items[$id]['qty'];
        $this->totalPrice = $this->totalPrice - $this->items[$id]['totalPrice'];
      }
    }

    // Main Arr
    $this->items[$id]   = $storedItem;
    $this->totalPrice   += $storedItem['totalPrice'];
    $this->totalQty     += $storedItem['qty'];
  }

  public function remove($id)
  {
    // Update TotalPrice
    $this->totalPrice = $this->totalPrice - $this->items[$id]['totalPrice'];
    // Update TotalQty
    $this->totalQty = $this->totalQty - $this->items[$id]['qty'];
    // Remove from items array
    unset($this->items[$id]);
  }

}
