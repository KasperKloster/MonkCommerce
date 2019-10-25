<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Str;
use Session;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceProductCategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductSubcategory;

class MonkAdminProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // All categories
      $productCategories = MonkCommerceProductCategory::paginate(6);
      // Eager loading
      $productSubCategories = MonkCommerceProductSubcategory::with('productCategories')->get();
      // Return View
      return view('monkcommerce::monkcommerce-dashboard.admin.categories.index')
              ->with('productCategories', $productCategories)
              ->with('productSubCategories', $productSubCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('monkcommerce::monkcommerce-dashboard.admin.categories.create');
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
          'categoryName'          => 'required|min:1|max:40|unique:monkcommerce_product_categories,name',
          'categoryDescription'   => 'nullable|max:1000',
          'showInMenu'            => 'nullable',
        ]);

        /*
        * Create Category
        */
        $category = new MonkCommerceProductCategory;
        $category->name         = $request->categoryName;
        $category->slug         = Str::slug($request->categoryName);
        $category->description  = $request->categoryDescription;
        $category->show_in_menu = $request->showInMenu;
        $category->save();

        /*
        * Message and Redirect
        */
        Session::flash('success', 'Category Has Been Created');
        return Redirect::route('monk-admin-categories-home');
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
        // Return View
        return view('monkcommerce::monkcommerce-dashboard.admin.categories.edit')
                ->with('category', $category);
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
          'categoryName'          => 'required|min:1|max:40|unique:monkcommerce_product_categories,name,' . $request->id,
          'categoryDescription'   => 'nullable|max:1000',
          'showInMenu'            => 'nullable|max:2',
        ]);

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
        $category->update();

        /*
        * Message and Redirect
        */
        Session::flash('success', 'Category Has Been Updated');
        return Redirect::route('monk-admin-categories-home');
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
