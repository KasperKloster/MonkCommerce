<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Str;
use Session;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;

class MonkAdminProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $productCategories = MonkCommerceProductCategory::whereNull('category_id')
                            ->with('productChildrenCategories')
                            ->get();

      return view('monkcommerce::monkcommerce-dashboard.admin.categories.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      if($request->has('parentCat'))
      {
        $parentCat = $request->parentCat;
      }
      else {
        $parentCat = NULL;
      }

      $productCategories = MonkCommerceProductCategory::all();

      return view('monkcommerce::monkcommerce-dashboard.admin.categories.create')
              ->with('parentCat', $parentCat)
              ->with('productCategories', $productCategories);
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
          'categoryName'          => 'required|min:1|max:40|unique:mc_product_categories,name',
          'categoryDescription'   => 'nullable|max:1000',
          'showInMenu'            => 'nullable',
          'mainCategory'          => 'nullable|integer'
        ]);

        // If maincat, make value to null
        if($request->mainCategory == '0')
        {
          $request->mainCategory = NULL;
        }

        /*
        * Create Category
        */
        $category = new MonkCommerceProductCategory;
        $category->name         = $request->categoryName;
        $category->slug         = Str::slug($request->categoryName);
        $category->description  = $request->categoryDescription;
        $category->show_in_menu = $request->showInMenu;
        $category->category_id  = $request->mainCategory;
        $category->save();

        /*
        * Message and Redirect
        */
        Session::flash('success', 'Maincategory Has Been Created');
        return Redirect::route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find Category
        $category = MonkCommerceProductCategory::find($id);
        // All Cats
        $productCategories = MonkCommerceProductCategory::all();
        // Return View
        return view('monkcommerce::monkcommerce-dashboard.admin.categories.edit')
                ->with('category', $category)
                ->with('productCategories', $productCategories);
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
          'categoryName'          => 'required|min:1|max:40|unique:mc_product_categories,name,' . $request->id,
          'categoryDescription'   => 'nullable|max:1000',
          'showInMenu'            => 'nullable|max:2',
          'mainCategory'          => 'nullable|integer'
        ]);

        // If maincat, make value to null
        if($request->mainCategory == '0')
        {
          $request->mainCategory = NULL;
        }
        // Getting Checkbox
        if($request->showInMenu == 'on')
        {
          $request->showInMenu = 1;
        }
        else
        {
          $request->showInMenu = NULL;
        }

        /*
        * Update
        */
        $category = MonkCommerceProductCategory::find($id);
        $category->name         = $request->categoryName;
        $category->slug         = Str::slug($request->categoryName);
        $category->description  = $request->categoryDescription;
        $category->show_in_menu = $request->showInMenu;
        $category->category_id  = $request->mainCategory;
        $category->update();

        /*
        * Message and Redirect
        */
        Session::flash('success', 'Category Has Been Updated');
        return Redirect::route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // Find given Category
      $category = MonkCommerceProductCategory::find($id);
      // Detach categories from all products (Has to be before subcats)
      $category->products()->detach();
      // Find All Subcategories
      $subCategories = MonkCommerceProductCategory::where('category_id', $category->id)->get();
      // Set all child subcategories to NULL
      foreach($subCategories as $subCategory)
      {
        $category = MonkCommerceProductCategory::find($subCategory->id);
        $category->category_id = NULL;
        $category->save();
      }
      // Delete Category
      $category->destroy($id);

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Category Has Been Deleted');
      return Redirect::route('categories.index');
    }
}
