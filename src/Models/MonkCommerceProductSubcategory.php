<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductcategory;

class MonkCommerceProductSubcategory extends Model
{
  // Name of the Table
  protected $table = 'monkcommerce_product_subcategories';

  protected $fillable = [
      'subcategory_name',
      'subcategory_description',
      'show_in_menu',
  ];

  /*
  * Relationships
  */
  // Product Categories
  public function productCategories()
  {
    //return $this->belongsTo('KasperKloster\MonkCommerce\Models\MonkCommerceProductcategory');
    return $this->belongsTo(MonkCommerceProductcategory::class, 'product_category_id', 'id');
  }


}
