@extends('monkcommerce::monkcommerce-storefront.layouts.checkout-main')
  @section('page-title')
    Checkout - Address
  @stop
  @section('seo-robots')
    <meta name="robots" content="noindex, nofollow">
  @stop
  @section('stylesheet')
  <link rel="stylesheet" href="{{ URL::asset('monkcommerce/css/storefront/checkout/checkout-style.min.css') }}">
  @stop

@section('left')
<div class="pt-4 mx-5">
  <h3>Checkout</h3>
  @include('monkcommerce::monkcommerce-storefront.shop.cart.checkout.partials._checkout-steps', ['step2' => FALSE, 'step3' => FALSE])
  <hr/>

  <form action="{{ route('monk-shop-checkout-billing-post') }}" method="post" id="checkout-form">
    @csrf
    <!-- Billing Adress -->
    <h5 class="mb-3">Billing Address</h5>
      <!-- Name -->
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="firstName">First name</label>
          <input type="text" class="form-control form-control-sm @error('firstName') is-invalid @enderror" id="firstName" name="firstName" value="{{ old('firstName') }}" required>
          @error('firstName')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="col-md-6 mb-3">
          <label for="lastName">Last name</label>
          <input type="text" class="form-control form-control-sm @error('lastName') is-invalid @enderror" id="lastName" name="lastName" value="{{ old('lastName') }}" required>
          @error('lastName')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <!-- Address -->
      <div class="mb-3">
        <label for="address">Address</label>
        <input type="text" class="form-control form-control-sm @error('streetAddress') is-invalid @enderror" id="streetAddress" name="streetAddress" value="{{ old('streetAddress') }}" required>
        @error('streetAddress')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <!-- Postal, city -->
      <div class="row">
        <div class="col-md-3 mb-3">
          <label for="postalCode">Postal Code</label>
          <input type="text" class="form-control form-control-sm @error('postalCode') is-invalid @enderror" id="postalCode" name="postalCode" value="{{ old('postalCode') }}" required>
          @error('postalCode')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="col-md-5 mb-3">
          <label for="city">City</label>
          <input type="text" class="form-control form-control-sm @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>
          @error('city')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="col-md-4 mb-3">
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
      <div class="row">
        <div class="col-md-7 mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
          @error('email')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <!-- phone -->
        <div class="col-md-5 mb-3 pb-2">
          <label for="phone">Phone</label>
          <input type="tel" class="form-control form-control-sm @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
          @error('phone')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <hr/>
      <!-- Buttons -->
      <div class="row d-flex justify-content-between pt-4">
        <div class="col-md-4">
          <a href="{{ route('monk-shop-cart-index') }}"><small>< Return to cart</small></a>
        </div>
        <div class="col-md-6">
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
