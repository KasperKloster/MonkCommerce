<?php

namespace KasperKloster\MonkCommerce\Models;

use Illuminate\Database\Eloquent\Model;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductSubcategory;

class MonkCommerceProductCategory extends Model
{
    // Name of the Table
    protected $table = 'monkcommerce_product_categories';

    protected $fillable = [
        'category_name',
        'category_description',
        'show_in_menu',
    ];

    /*
    * Relationships
    */

    // Product Subcategories
    public function productSubcategories()
    {
      return $this->hasMany(MonkCommerceProductSubcategory::class);
    }
}
