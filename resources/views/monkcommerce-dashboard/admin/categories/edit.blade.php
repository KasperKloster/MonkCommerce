@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-main')
  @section('page-title')
    {{ ucwords(__('monkcommerce-dashboard.categories.edit_category')) }} | Admin Dashboard
  @stop

  @section('content')
  <!-- breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page">
        <a class="mat-inline-center text-decoration-none" href="{{ URL::previous() }}"><i class="material-icons">keyboard_backspace</i> Back</a>
      </li>
    </ol>
  </nav>
  <!-- Header -->
  <h1>{{ ucwords(__('monkcommerce-dashboard.categories.edit_category')) }}</h1>
  <!-- Messages -->
  @include('monkcommerce::monkcommerce-dashboard.layouts.partials._messages')

    <!-- Page Content -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            <form action="{{ route('monk-admin-update-category', $category->id) }}" method="post">
              @csrf
              <div class="form-group">
                <label for="categoryName">{{ ucwords(__('monkcommerce-dashboard.categories.category_name')) }}</label>
                <input type="text" class="form-control" name="categoryName" id="categoryName" value="{{ $category->name }}" required>
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
    </div>
  </div>
  @stop
