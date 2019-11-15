@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.categories.all_categories')) }}| Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-index')

@section('header')
<h1>{{ ucwords(__('monkcommerce-dashboard.categories.all_categories')) }}</h1>
@stop

@section('card-btn')
<a href="{{ route('monk-admin-create-category') }}" class="btn btn-sm btn-success">{{ ucwords(__('monkcommerce-dashboard.categories.create_new_category')) }}</a>
@stop

@section('card-content')
<div class="pb-4 pt-3">
  <div class="form-row ml-1">
    <div class="col">
      @foreach ($productCategories as $category)
      <b>{{ $category->name }}</b>
      <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('monk-admin-edit-category', $category->id) }}" class="btn btn-sm btn-info mat-inline-center"><i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}</a>
        <a href="{{ route('monk-admin-create-category', ['parentCat' => $category->id])}}" class="btn btn-sm btn-success mat-inline-center"><i class="material-icons">add</i> {{ ucwords(__('monkcommerce-dashboard.categories.create_subcategory')) }}</a>
        <a href="{{ route('monk-shop-single-category', $category->slug )}}" class="btn btn-sm btn-outline-secondary mat-inline-center">{{ ucwords(__('monkcommerce-dashboard.general-words.show_in_shop')) }}<i class="material-icons">open_in_new</i></a>
        <a href="{{ route('monk-admin-destroy-category', $category->id) }}" class="btn btn-sm btn-danger mat-inline-center"><i class="material-icons">delete_forever</i> {{ ucwords(__('monkcommerce-dashboard.general-words.delete')) }}</a>
      </div>

        @foreach ($category->productChildrenCategories as $childCategory)
            @include('monkcommerce::monkcommerce-dashboard.admin.partials._child_category', ['child_category' => $childCategory])
        @endforeach

      @endforeach
    </div>
  </div>
</div>

<!-- Pagination -->
{{-- <div class="row pt-3">
<div class="col-md-12">
<div class="d-flex justify-content-center">
{{ $productCategories->links() }}
</div>
</div>
</div> --}}

@stop
