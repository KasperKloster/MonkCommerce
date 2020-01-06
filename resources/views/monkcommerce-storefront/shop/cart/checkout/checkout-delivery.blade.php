@extends('monkcommerce::monkcommerce-storefront.layouts.checkout-main')
  @section('page-title')
    Checkout - Delivery
  @stop
  @section('seo-robots')
    <meta name="robots" content="noindex, nofollow">
  @stop
  @section('stylesheet')
  <link rel="stylesheet" href="{{ URL::asset('monkcommerce/css/storefront/checkout/checkout-style.css') }}">
  @stop

@section('left')
  <div class="pt-4 mx-5">
    <h3>Checkout</h3>
    @include('monkcommerce::monkcommerce-storefront.shop.cart.checkout.partials._checkout-steps', ['step2' => TRUE])
    <hr/>

    <form action="{{ route('monk-shop-checkout-billing-post') }}" method="post" id="checkout-form">
      @csrf
      <!-- Billing Adress -->
      <h5 class="mb-3">Delivery Address</h5>
        <!-- Name -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control form-control-sm @error('firstName') is-invalid @enderror" id="firstName" name="firstName" placeholder="" value="{{ old('firstName') }}" required>
            @error('firstName')
              <small class="text-danger">{{ $message }}</small>
            @enderror

          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control form-control-sm @error('lastName') is-invalid @enderror" id="lastName" name="lastName" placeholder="" value="{{ old('lastName') }}" required>
            @error('lastName')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <!-- Address -->
        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control form-control-sm @error('streetAddress') is-invalid @enderror" id="streetAddress" name="streetAddress" placeholder="1234 Main St" value="{{ old('streetAddress') }}" required>
          @error('streetAddress')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <!-- Postal, city -->
        <div class="row">
          <div class="col-md-2 mb-3">
            <label for="postalCode">Postal Code</label>
            <input type="text" class="form-control form-control-sm @error('postalCode') is-invalid @enderror" id="postalCode" name="postalCode" placeholder="2200" value="{{ old('postalCode') }}" required>
            @error('postalCode')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="col-md-5 mb-3">
            <label for="city">City</label>
            <input type="text" class="form-control form-control-sm @error('city') is-invalid @enderror" id="city" name="city" placeholder="Copenhagen" value="{{ old('city') }}" required>
            @error('city')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="d-block w-100 form-control form-control-sm @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country') }}" required>
              <option disabled>Choose...</option>
              <option>United States</option>
            </select>
            @error('country')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <!-- Info -->
        <div class="mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
          @error('email')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <!-- phone -->
        <div class="mb-3">
          <label for="phone">Phone</label>
          <input type="tel" class="form-control form-control-sm @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="12 34 56 78" value="{{ old('phone') }}" required>
          @error('phone')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <!-- Buttons -->
        <div class="row d-flex justify-content-between">
          <div class="col-md-4">
            <a href="{{ route('monk-shop-cart-index') }}"><small>< Return to cart</small></a>
          </div>
          <div class="col-md-4">
            <button class="btn btn-success btn-md btn-block" type="submit">Continue to Delivery</button>
          </div>
        </div>
    </form>
  </div>
@stop


@section('right')
  <div class="pt-4 ml-3">
    @include('monkcommerce::monkcommerce-storefront.shop.cart.checkout.partials._display-cart')
  </div>
@stop
