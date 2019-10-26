@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.categories.create_new_category')) }} | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-create')

  @section('header')
    {{ ucwords(__('monkcommerce-dashboard.categories.create_new_category')) }}
  @stop

  @section('form')
  <form action="{{ route('monk-admin-store-category') }}" method="post">
    @csrf
    <div class="form-group">
      <label for="categoryName">{{ ucwords(__('monkcommerce-dashboard.categories.category_name')) }}</label>
      <input type="text" class="form-control" name="categoryName" id="categoryName" placeholder="{{ ucwords(__('monkcommerce-dashboard.categories.category_name')) }}" required>
      <input type="hidden" name="parentCat" value="{{ $parentCat }}">
    </div>

    LIST OF ALL, IF NONE SELECTED THEN MAIN

    <div class="form-group">
      <label for="categoryDescription">{{ ucwords(__('monkcommerce-dashboard.categories.category_description')) }}</label>
      <textarea class="form-control" name="categoryDescription" id="categoryDescription" rows="3" required></textarea>
    </div>

    <div class="form-check">
      <input type="checkbox" class="form-check-input" name="showInMenu" id="showInMenu" value="1">
      <label class="form-check-label" for="showInMenu">{{ ucwords(__('monkcommerce-dashboard.categories.show_in_menu')) }}</label>
    </div>

    <div class="form-group row pt-3">
      <div class="col">
        <button class="btn btn-success" type="submit">{{ ucwords(__('monkcommerce-dashboard.general-words.save')) }}</button>
        <input class="btn btn-outline-secondary" type="reset" value="{{ ucwords(__('monkcommerce-dashboard.general-words.reset')) }}" />
      </div>
    </div>
  </form>
  @stop
