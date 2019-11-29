@extends('monkcommerce::monkcommerce-storefront.layouts.storefront-main')
  @section('page-title')
    Checkout
  @stop
  @section('seo-robots')
    <meta name="robots" content="noindex, nofollow">
  @stop

@section('content')
<div class="container mb-5">
  <div class="py-5 text-center">
    <h2>Checkout</h2>
    <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
  </div>

  <div class="row">
    <!-- Your Cart -->
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill">{{ $cart->totalQty }}</span>
      </h4>
      @foreach($products as $product)
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">{{ $product['item']['name'] }}</h6>
            <small class="text-muted">
            @for ($i = 0; $i < count($product['item']['attributeValues']); $i++)
              | {{ $product['item']['attributeValues'][$i]['value'] }}
            @endfor
            </small>
          </div>
          @if ($product['item']['special_price'])
            <span class="text-muted"><s>{{ showPrice($product['item']['price']) }}</s></span>
            <span class="text-muted">{{ showPrice($product['item']['special_price']) }}</span>
          @else
            <span class="text-muted">{{ showPrice($product['item']['price']) }}</span>
          @endif
        </li>
        @endforeach
        <!-- Promo Code Success -->
        {{-- <li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-success">
            <h6 class="my-0">Promo code</h6>
            <small>EXAMPLECODE</small>
          </div>
          <span class="text-success">-$5</span>
        </li> --}}
        <!-- Total -->
        <li class="list-group-item d-flex justify-content-between">
          <span>Total</span>
          <strong><u>{{ showPrice($cart->totalPrice) }}</u></strong>
        </li>

        @if(Session::has('error'))
        <!-- Charge Error -->
        <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}">
          {{ Session::get('error') }}
        </div>
        @endif
      </ul>

      <!-- Promo Code -->
      {{-- <form class="card p-2">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Promo code">
          <div class="input-group-append">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </div>
      </form> --}}
    </div>

    <!-- Adress -->
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      <form action="{{ route('monk-shop-checkout')}}" method="post" id="checkout-form">
        @csrf
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required="">
            <div class="invalid-feedback">
            Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required="">
            <div class="invalid-feedback">
            Valid last name is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required="">
          <div class="invalid-feedback">
          Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required="">
          <div class="invalid-feedback">
          Please enter your shipping address.
          </div>
        </div>

        <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" id="country" required="">
            <option value="">Choose...</option>
            <option>United States</option>
            </select>
            <div class="invalid-feedback">
            Please select a valid country.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select class="custom-select d-block w-100" id="state" required="">
            <option value="">Choose...</option>
            <option>California</option>
            </select>
            <div class="invalid-feedback">
            Please provide a valid state.
            </div>
          </div>

          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" id="zip" name="zip" placeholder="" required="">
            <div class="invalid-feedback">
            Zip code required.
            </div>
          </div>
        </div>

        <hr class="mb-4">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="same-address">
          <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
        </div>
        <hr class="mb-4">

        <!-- Payment -->
        <h4 class="mb-3">Payment</h4>
        <div class="d-block my-3">
          <div class="custom-control custom-radio">
            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
            <label class="custom-control-label" for="credit">Credit card</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
            <label class="custom-control-label" for="debit">Debit card</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
            <label class="custom-control-label" for="paypal">PayPal</label>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="cc-name">Name on card</label>
            <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder="" required="">
            <small class="text-muted">Full name as displayed on card</small>
            <div class="invalid-feedback">
              Name on card is required
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <label for="cc-number">Credit card number</label>
            <input type="text" class="form-control" id="cc-number" name="cc-number" placeholder="" required="">
            <div class="invalid-feedback">
              Credit card number is required
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="cc-expiration">Expiration</label>
            <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" placeholder="" required="">
            <div class="invalid-feedback">
              Expiration date required
            </div>
          </div>

          <div class="col-md-3 mb-3">
            <label for="cc-cvv">CVV</label>
            <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder="" required="">
            <div class="invalid-feedback">
            Security code required
            </div>
          </div>
        </div>

        <hr class="mb-4">
        <button class="btn btn-success btn-lg btn-block" type="submit">Continue to Payment</button>
      </form>
    </div>
  </div>

</div> <!-- /.container -->

@stop
