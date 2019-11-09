<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Str;
use Session;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttribute;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttributeValue;


class MonkAdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products = MonkCommerceProduct::paginate(10);
      return view('monkcommerce::monkcommerce-dashboard.admin.products.index')
              ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $productCategories = MonkCommerceProductCategory::all();
      $productAttributes = MonkCommerceProductAttribute::with('attributeValues')->get();

      return view('monkcommerce::monkcommerce-dashboard.admin.products.create')
              ->with('productCategories', $productCategories)
              ->with('productAttributes', $productAttributes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      /*
      * Validate
      */
      $request->validate([
        'productName'         => 'required|min:1|max:255|unique:mc_products,name',
        'productSku'          => 'required|unique:mc_products,sku',
        'productQty'          => 'required|integer',
        'productPrice'        => 'required',
        'productSpecialPrice' => 'nullable',
        'productDescription'  => 'nullable',
        'productInStock'      => 'nullable|max:2',
        'productAttr'         => 'nullable|array',
        'productCategories'   => 'required|array',
      ]);

      // Getting Checkbox
      if($request->productInStock == 'on')
      {
        $request->productInStock = 1;
      }
      else
      {
        $request->productInStock = NULL;
      }

      /*
      * Create Product
      */
      $product = new MonkCommerceProduct;
      $product->sku           = $request->productSku;
      $product->name          = $request->productName;
      $product->slug          = Str::slug($request->productName);
      $product->description   = $request->productDescription;
      $product->price         = $request->productPrice;
      $product->special_price = $request->productSpecialPrice;
      $product->qty           = $request->productQty;
      $product->in_stock      = $request->productInStock;
      $product->save();

      // Attach attributes
      // for ($i = 0; $i < count($request->productAttr); $i++)
      // {
      //   $attrValue = MonkCommerceProductAttributeValue::find($request->productAttr[$i]);
      //   $product->attributeValues()->attach($attrValue);
      // }

      $attrValue = MonkCommerceProductAttributeValue::find($request->productAttr);
      $product->attributeValues()->attach($attrValue);

      // Attach Product to Categorie(s)
      $productCategory = MonkCommerceProductCategory::find($request->productCategories);
      $product->productCategories()->attach($productCategory);

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Product Has Been Created');
      return Redirect::route('monk-admin-products-home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $product = MonkCommerceProduct::find($id);
      $productCategories = MonkCommerceProductCategory::all();
      $productAttributes = MonkCommerceProductAttribute::with('attributeValues')->get();

      return view('monkcommerce::monkcommerce-dashboard.admin.products.edit')
              ->with('product', $product)
              ->with('productCategories', $productCategories)
              ->with('productAttributes', $productAttributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      /*
      * Validate
      */
      $request->validate([
        'productName'         => 'required|min:1|max:255|unique:mc_products,name,' . $request->id,
        //'productSku'          => 'required|unique:mc_products,sku,' . $request->productSku,
        'productQty'          => 'required|integer',
        'productPrice'        => 'required',
        'productSpecialPrice' => 'nullable',
        'productDescription'  => 'nullable',
        'productInStock'      => 'nullable|max:2',
        'productCategories'   => 'required|array',
      ]);

      // Getting Checkbox
      if($request->productInStock == 'on')
      {
        $request->productInStock = 1;
      }
      else
      {
        $request->productInStock = NULL;
      }

      /*
      * Update Product
      */
      $product =  MonkCommerceProduct::find($id);
      $product->sku           = $request->productSku;
      $product->name          = $request->productName;
      $product->slug          = Str::slug($request->productName);
      $product->description   = $request->productDescription;
      $product->price         = $request->productPrice;
      $product->special_price = $request->productSpecialPrice;
      $product->qty           = $request->productQty;
      $product->in_stock      = $request->productInStock;
      $product->update();


      // Sync Product to Categorie(s)
      //$productCategory = MonkCommerceProductCategory::find($request->productCategories);
      $product->productCategories()->sync($request->productCategories);

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Product Has Been Updated');
      return Redirect::route('monk-admin-products-home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $product = MonkCommerceProduct::find($id);
      // Detach products from all categories
      $product->productCategories()->detach();
      // Detach attributes
      $product->attributeValues()->detach();
      // Delete the product
      $product->destroy($id);

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Product Has Been Deleted');
      return Redirect::route('monk-admin-products-home');
    }
}
