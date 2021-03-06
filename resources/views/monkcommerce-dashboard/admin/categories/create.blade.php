@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.categories.create_new_category')) }} | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-form')


@section('page-content')
<form action="{{ route('categories.store') }}" class="needs-validation" method="post">
  @csrf
  <div class="card">
    <div class="card-header">
    {{ ucwords(__('monkcommerce-dashboard.categories.create_new_category')) }}
    </div>

    <div class="card-body">

      <div class="form-group">
        <label for="categoryName">{{ ucwords(__('monkcommerce-dashboard.categories.category_name')) }}</label>
        <input type="text" class="form-control" name="categoryName" id="categoryName" value="{{old('categoryName')}}" placeholder="{{ ucwords(__('monkcommerce-dashboard.categories.category_name')) }}" required>
        @if ($errors->has('categoryName'))
          @foreach($errors->get('categoryName') as $error)
            {{ $error }}
          @endforeach
        @endif
      </div>

      <div class="form-group">
        <label for="mainCategory">{{ ucwords(__('monkcommerce-dashboard.categories.main_category')) }}</label>
          <select class="form-control" id="mainCategory" name="mainCategory">
            <option selected value="0">-- {{ ucwords(__('monkcommerce-dashboard.categories.create_new_main_category')) }}--</option>
            @foreach ($productCategories as $productCategory)
              @if ($parentCat == $productCategory->id)
                <option value="{{ $productCategory->id }}" selected>{{ $productCategory->name }}</option>
              @endif
              <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
            @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="categoryDescription">{{ ucwords(__('monkcommerce-dashboard.categories.category_description')) }}</label>
        <textarea class="form-control" name="categoryDescription" id="categoryDescription" rows="3" required>{{old('categoryDescription')}}</textarea>
        @if ($errors->has('categoryDescription'))
          @foreach($errors->get('categoryDescription2') as $error)
            {{ $error }}
          @endforeach
        @endif
      </div>

      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="showInMenu" id="showInMenu" value="1">
        <label class="form-check-label" for="showInMenu">{{ ucwords(__('monkcommerce-dashboard.categories.show_in_menu')) }}</label>
      </div>
    </div>
    <div class="card-footer">
      <div class="form-group row pt-3">
        <div class="col">
          <button class="btn btn-success" type="submit">{{ ucwords(__('monkcommerce-dashboard.general-words.save')) }}</button>
          <input class="btn btn-outline-secondary" type="reset" value="{{ ucwords(__('monkcommerce-dashboard.general-words.reset')) }}" />
        </div>
      </div>
    </div>
  </div>
</form>
@stop
