<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Str;
use Session;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;

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
      return view('monkcommerce::monkcommerce-dashboard.admin.products.create');
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
        'productName'         => 'required|min:1|max:255|unique:monkcommerce_products,name',
        'productSku'          => 'required|unique:monkcommerce_products,sku',
        'productQty'          => 'required|integer',
        'productPrice'        => 'required',
        'productSpecialPrice' => 'nullable',
        'productDescription'  => 'nullable',
        'productInStock'      => 'nullable|max:2'
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

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Product Has Been Created');
      return Redirect::route('monk-admin-products-home');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $product = MonkCommerceProduct::find($id);
      return view('monkcommerce::monkcommerce-dashboard.admin.products.edit')
              ->with('product', $product);
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
        'productName'         => 'required|min:1|max:255|unique:monkcommerce_products,name,' . $request->id,
        'productSku'          => 'required|unique:monkcommerce_products,sku,'  . $request->productSku,
        'productQty'          => 'required|integer',
        'productPrice'        => 'required',
        'productSpecialPrice' => 'nullable',
        'productDescription'  => 'nullable',
        'productInStock'      => 'nullable|max:2'
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
        //
    }
}
