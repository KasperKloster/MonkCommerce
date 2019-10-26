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

      return view('monkcommerce::monkcommerce-dashboard.admin.categories.create')
              ->with('parentCat', $parentCat);
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
          'parentCat'             => 'nullable|integer'
        ]);

        /*
        * Create Category
        */
        $category = new MonkCommerceProductCategory;
        $category->name         = $request->categoryName;
        $category->slug         = Str::slug($request->categoryName);
        $category->description  = $request->categoryDescription;
        $category->show_in_menu = $request->showInMenu;
        $category->category_id  = $request->parentCat;
        $category->save();

        /*
        * Message and Redirect
        */
        Session::flash('success', 'Maincategory Has Been Created');
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
