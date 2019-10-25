@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-main')
  @section('page-title')
    {{ ucwords(__('monkcommerce-dashboard.left-panel.shop_settings')) }}
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
  <!-- Header -->
  <h1>{{ ucwords(__('monkcommerce-dashboard.left-panel.shop_settings')) }}</h1>
  <!-- Messages -->
  @include('monkcommerce::monkcommerce-dashboard.layouts.partials._messages')



    <!-- Page Content -->
    <div class="row">
      <div class="col-md-12">
        <!-- Table Header -->
        <div class="card">
          <div class="card-header">
            {{ ucwords(__('monkcommerce-dashboard.shop-information.shop_information')) }}
          </div>
          <div class="card-body">

            <form action="{{ route('monk-admin-store-shop-informations') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="shop_name">{{ ucwords(__('monkcommerce-dashboard.shop-information.shop_name')) }}*</label>
                <input type="text" class="form-control" id="shop_name" name="shop_name" value="{{ $shop->shop_name }}" required>
                <input type="hidden" class="form-control" name="shop_val" value="{{ $shop->id }}" required>
              </div>

              <div class="form-group">
                <label for="street_address">{{ ucwords(__('monkcommerce-dashboard.shop-information.street_address')) }}*</label>
                <input type="text" class="form-control" id="street_address" name="street_address" value="{{ $shop->street_address }}" required>
              </div>

              <div class="form-group row">
                <div class="col">
                  <label for="postal_code">{{ ucwords(__('monkcommerce-dashboard.shop-information.postal_code')) }}*</label>
                  <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $shop->postal_code }}" required>
                </div>
                <div class="col">
                  <label for="city">{{ ucwords(__('monkcommerce-dashboard.shop-information.city')) }}*</label>
                  <input type="text" class="form-control" id="city" name="city" value="{{ $shop->city }}" required>
                </div>
                <div class="col">
                  <label for="country">{{ ucwords(__('monkcommerce-dashboard.shop-information.country')) }}*</label>
                  <input type="text" class="form-control" id="country" name="country" value="{{ $shop->country }}" required>

                </div>
              </div>

              <div class="form-group row">
                <div class="col">
                  <label for="phone">{{ ucwords(__('monkcommerce-dashboard.shop-information.phone')) }}</label>
                  <input type="tel" class="form-control" id="phone" name="phone" value="{{ $shop->phone }}">
                </div>
                <div class="col">
                  <label for="email">{{ ucwords(__('monkcommerce-dashboard.shop-information.email')) }}</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ $shop->email }}">
                  <small id="emailHelp" class="form-text text-muted">{{ ucfirst(__('monkcommerce-dashboard.shop-information.emailHelp')) }}</small>
                </div>
                <div class="col">
                  <label for="url">{{ ucwords(__('monkcommerce-dashboard.shop-information.url')) }}</label>
                  <input type="url" class="form-control" id="url" name="url" value="{{ $shop->url }}">
                </div>
              </div>

              <div class="form-group">
                <label for="vat_number">{{ ucwords(__('monkcommerce-dashboard.shop-information.vat_number')) }}</label>
                <input type="text" class="form-control" id="vat_number" name="vat_number" value="{{ $shop->vat_number }}">
              </div>

              <div class="form-group row pt-3">
                <div class="col">
                  <button type="submit" class="btn btn-success">{{ ucwords(__('monkcommerce-dashboard.general-words.save')) }}</button>
                </div>
              </div>


            </form>


          </div>
        </div>
      </div>
    </div>
  @stop
