@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.categories.edit_category')) }} | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-form')

@section('page-content')
<div class="card">
  <div class="card-header">
    {{ ucwords(__('monkcommerce-dashboard.categories.edit_category')) }}
  </div>
  <div class="card-body">
    <form action="{{ route('monk-admin-update-category', $category->id) }}" method="post">
      @csrf
      <div class="form-group">
        <label for="categoryName">{{ ucwords(__('monkcommerce-dashboard.categories.category_name')) }}</label>
        <input type="text" class="form-control" name="categoryName" id="categoryName" value="{{ $category->name }}" required>
      </div>

      <div class="form-group">
        <label for="mainCategory">{{ ucwords(__('monkcommerce-dashboard.categories.main_category')) }}</label>
        <select class="form-control" id="mainCategory" name="mainCategory">
          <option selected value="0">-- {{ ucwords(__('monkcommerce-dashboard.categories.create_new_main_category')) }}--</option>
          @foreach ($productCategories as $productCategory)
            <option value="{{ $productCategory->id }}"
              @if ($category->category_id == $productCategory->id)
              selected
              @endif
           >{{ $productCategory->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="categoryDescription">{{ ucwords(__('monkcommerce-dashboard.categories.category_description')) }}</label>
        <textarea class="form-control" name="categoryDescription" id="categoryDescription" rows="3" required>{{ $category->description }}</textarea>
      </div>

      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="showInMenu" id="showInMenu" @if($category->show_in_menu == 1) checked @endif>
        <label class="form-check-label" for="showInMenu">{{ ucwords(__('monkcommerce-dashboard.categories.show_in_menu')) }}</label>
      </div>

      <div class="form-group row pt-3">
        <div class="col">
          <button type="submit" class="btn btn-success">{{ ucwords(__('monkcommerce-dashboard.general-words.save')) }}</button>
          <input type="reset" class="btn btn-outline-secondary" value="{{ ucwords(__('monkcommerce-dashboard.general-words.reset')) }}" />
        </div>
      </div>
    </form>
  </div>
</div>
@stop
