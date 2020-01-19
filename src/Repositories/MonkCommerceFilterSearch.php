<?php

namespace KasperKloster\MonkCommerce\Repositories;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;


class MonkCommerceFilterSearch
{
  public function productFilter($category, $request)
  {
    /* Validate Request */
    $request->validate([
      'attributeValue'    => 'required|array',
      'attributeValue.*'  => 'integer',
    ]);
    /* Filterered Attrbutes / set */
    $setAttr = $request->attributeValue;

    /* Find Products in DB */
    $products = $category->products()->whereHas('attributeValues', function ($query) use ($setAttr) {
        $query->whereIn('product_attribute_value_id', $setAttr);
    })->paginate(10);

    return [$setAttr, $products];
  }

  public function navbarSearch($request)
  {
    /* Validate Request */
    $request->validate([
      'q'    => 'required|string',
    ]);

    $result = MonkCommerceProduct::where('name', 'like', '%' . $request->q . '%')
                                  ->orWhere('description', 'like', '%' . $request->q . '%')
                                  ->with('images')
                                  ->with('attributeValues')
                                  ->paginate(10);
    return $result;
  }


}
