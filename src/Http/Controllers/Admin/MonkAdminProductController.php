<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Str;
use Session;
use File;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttribute;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductImage;

// Repos
use KasperKloster\MonkCommerce\Repositories\Dashboard\CreateProduct;
use KasperKloster\MonkCommerce\Repositories\Dashboard\UpdateProduct;

class MonkAdminProductController extends Controller
{
    public function index()
    {
      $products = MonkCommerceProduct::paginate(10);
      return view('monkcommerce::monkcommerce-dashboard.admin.products.index')
              ->with('products', $products);
    }

    public function create()
    {
      $productCategories = MonkCommerceProductCategory::all();
      $productAttributes = MonkCommerceProductAttribute::with('attributeValues')->get();

      return view('monkcommerce::monkcommerce-dashboard.admin.products.create')
              ->with('productCategories', $productCategories)
              ->with('productAttributes', $productAttributes);
    }

    public function store(Request $request)
    {
      /* Validate & Store */
      $product = MonkCommerceProduct::create($this->validateRequest(null));
      // Find recently created. Make slug from name
      $productSlug = MonkCommerceProduct::find($product->id);
      $productSlug->slug = Str::slug($product->name);
      $productSlug->update();

      /* Attributes */
      $productInfo = new CreateProduct;
      // Attach Categories and Attributes
      $productInfo->attachAttributes($request->productCategories, $request->productAttr, $product);
      // Product Images
      if (request()->hasFile('filename'))
      {
        $productInfo->setImages($request->file('filename'), $product);
      }
      // Set default image, if none image has been chosed
      else
      {
        $imageModel = new MonkCommerceProductImage;
        $imageModel->product_id = $product->id;
        $imageModel->filename   = '/default.jpg';
        $imageModel->main = '1';
        $imageModel->save();
      }
      /* Message and Redirect */
      Session::flash('success', 'Product Has Been Created');
      return Redirect::route('products.index');
    }

    public function edit(MonkCommerceProduct $product)
    {
      $product->with('image');

      $productCategories = MonkCommerceProductCategory::all();
      $productAttributes = MonkCommerceProductAttribute::with('attributeValues')->get();

      return view('monkcommerce::monkcommerce-dashboard.admin.products.edit')
              ->with('product', $product)
              ->with('productCategories', $productCategories)
              ->with('productAttributes', $productAttributes);
    }

    public function update(Request $request, MonkCommerceProduct $product)
    {
      $product->update($this->validateRequest($product->id));
      // Find recently created. Make slug from name
      $productSlug = MonkCommerceProduct::find($product->id);
      $productSlug->slug = Str::slug($product->name);
      $productSlug->update();

      $productInfo = new UpdateProduct;
      // Atttributes and Cats
      $productInfo->syncAttributes($request->productCategories, $request->productAttr, $product);
      // Images
      $productInfo->updateImages($request, $product);

      /* Message and Redirect */
      Session::flash('success', 'Product Has Been Updated');
      return Redirect::route('products.index');
    }

    public function destroy(MonkCommerceProduct $product)
    {

      // Detach products from all categories
      $product->productCategories()->detach();
      // Detach attributes
      $product->attributeValues()->detach();
      // Delete Images
      foreach ($product->images as $image)
      {
        // Delete public_folder from Server
        $image_path = public_path().'/monkcommerce/images/products/' . $product->id . '/';
        File::deleteDirectory($image_path);
        // Delete from DB
        $image->destroy($image->id);
      }
      // Finally Delete the product
      $product->destroy($product->id);

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Product Has Been Deleted');
      return Redirect::route('products.index');
    }

    private function validateRequest($id)
    {
      return request()->validate([
        'name'          => 'required|min:1|max:255|unique:mc_products,name,' . $id,
        'sku'           => 'required|unique:mc_products,sku,' . $id,
        'qty'           => 'required|integer',
        'price'         => 'required',
        'special_price' => 'nullable',
        'weight'        => 'nullable|integer',
        'description'   => 'nullable',
        'productAttr'         => 'nullable|array',
        'productCategories'   => 'required|array',
        'filename.*'          => 'file|image|max:5000',
      ]);
    }
}
