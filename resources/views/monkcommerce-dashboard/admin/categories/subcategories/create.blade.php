@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-main')
  @section('page-title')
    {{ ucwords(__('monkcommerce-dashboard.categories.create_subcategory')) }} | Admin Dashboard
  @stop

  @section('content')
  <!-- breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page">
        <a class="mat-inline-center text-decoration-none" href="{{ URL::previous() }}"><i class="material-icons">keyboard_backspace</i> {{ ucwords(__('monkcommerce-dashboard.general-words.back')) }}</a>
      </li>
    </ol>
  </nav>
  <!-- header -->
  <h1>{{ ucwords(__('monkcommerce-dashboard.categories.create_subcategory')) }}</h1>
  <!-- Messages -->
  @include('monkcommerce::monkcommerce-dashboard.layouts.partials._messages')

    <!-- Page Content -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            <form action="{{ route('monk-admin-store-subcategory') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="mainCategoryName">{{ ucwords(__('monkcommerce-dashboard.categories.main_category')) }}</label>
                <input type="text" class="form-control" name="mainCategoryName" id="mainCategoryName" placeholder="{{ $mainCategory->name }}" required disabled>
                <input type="hidden" class="form-control" name="mainCategoryValue" id="mainCategoryValue" value="{{ $mainCategory->id }}" required>
              </div>

              <div class="form-group">
                <label for="subcategoryName">{{ ucwords(__('monkcommerce-dashboard.categories.subcategory_name')) }}</label>
                <input type="text" class="form-control" name="subcategoryName" id="subcategoryName" placeholder="{{ ucwords(__('monkcommerce-dashboard.categories.subcategory_name')) }}" required>
              </div>

              <div class="form-group">
                <label for="subcategoryDescription">{{ ucwords(__('monkcommerce-dashboard.general-words.description')) }}</label>
                <textarea class="form-control" name="subcategoryDescription" id="subcategoryDescription" rows="3" required></textarea>
              </div>

              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="showInMenu" id="showInMenu" value="1">
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
