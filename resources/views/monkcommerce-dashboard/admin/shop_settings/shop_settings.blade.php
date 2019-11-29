@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.left-panel.shop_settings')) }}
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-form')

@section('header')
  {{ ucwords(__('monkcommerce-dashboard.left-panel.shop_settings')) }}
@stop

@section('page-content')

<form action="{{ route('monk-admin-store-shop-informations') }}" method="post">
  @csrf

  <div class="row">
    <!-- Shop Informations -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          {{ ucwords(__('monkcommerce-dashboard.shop-information.shop_information')) }}
        </div>

        <div class="card-body">
          <div class="form-group">
            <label for="shop_name">{{ ucwords(__('monkcommerce-dashboard.shop-information.shop_name')) }}</label>
            <input type="text" class="form-control" id="shop_name" name="shop_name" value="{{ $shop->shop_name }}">
            <input type="hidden" class="form-control" name="shop_val" value="{{ $shop->id }}" required>
          </div>

          <div class="form-group">
            <label for="street_address">{{ ucwords(__('monkcommerce-dashboard.shop-information.street_address')) }}</label>
            <input type="text" class="form-control" id="street_address" name="street_address" value="{{ $shop->street_address }}">
          </div>

          <div class="form-group row">
            <div class="col">
              <label for="postal_code">{{ ucwords(__('monkcommerce-dashboard.shop-information.postal_code')) }}</label>
              <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $shop->postal_code }}">
            </div>
            <div class="col">
              <label for="city">{{ ucwords(__('monkcommerce-dashboard.shop-information.city')) }}</label>
              <input type="text" class="form-control" id="city" name="city" value="{{ $shop->city }}">
            </div>
            <div class="col">
              <label for="country">{{ ucwords(__('monkcommerce-dashboard.shop-information.country')) }}</label>
              <input type="text" class="form-control" id="country" name="country" value="{{ $shop->country }}">
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
        <hr/>
        <div class="form-group">
          <label for="vat_number">{{ ucwords(__('monkcommerce-dashboard.shop-information.vat_number')) }}</label>
          <input type="text" class="form-control" id="vat_number" name="vat_number" value="{{ $shop->vat_number }}">
        </div>

        <div class="form-group row">
          <div class="col">
            <label for="shopCurrency">Currency</label>
            <input type="text" class="form-control" id="shopCurrency" name="shopCurrency" value="{{ $shop->shopCurrency }}" required>
            <small id="shopshopCurrency" class="form-text text-muted">The price displayed on the shop pages.</small>
          </div>

          <div class="col">
            <label for="shopSchemaCurrency">Schema Currency</label>
            <input type="text" class="form-control" id="shopSchemaCurrency" name="shopSchemaCurrency" value="{{ $shop->shopSchemaCurrency }}" required>
            <small id="shopshopCurrency" class="form-text text-muted"><a href="https://en.wikipedia.org/wiki/ISO_4217" target="_blank">ISO 4217 standard currency format.</a> Used for Stripe and structured data.</small>
          </div>
        </div>

        <div class="form-group">
          <label for="stripe_publishable_key">Stripe Publishable Key</label>
          <input type="text" class="form-control" id="stripe_publishable_key" name="stripe_publishable_key" value="{{ $shop->stripe_publishable_key }}">
        </div>

        <hr/>
        <div class="form-group">
          <label for="shopPrefix">Prefix</label>
          <input type="text" class="form-control" id="shopPrefix" name="shopPrefix" value="{{ $shop->shopPrefix }}">
          <small id="shopPrefixHelp" class="form-text text-muted">Will be shown at page titles on all shop pages (categories and products) Eg. | {{ $shop->shop_name }}</small>
        </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Cookie Consent Message -->
  <div class="card mt-3">
    <div class="card-header">
      Cookie Consent Message
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="shopCookieConsentMsg">Message</label>
          <textarea class="form-control" name="shopCookieConsentMsg" id="shopCookieConsentMsg" rows="3">{{ $shop->cookie_msg }}</textarea>
      </div>
    </div>
  </div>

  <!-- Submit btn -->
  <div class="d-flex justify-content-end pt-3">
    <div class="form-group row">
      <div class="col right">
        <button type="submit" class="btn btn-md btn-success">{{ ucwords(__('monkcommerce-dashboard.general-words.save')) }}</button>
      </div>
    </div>
  </div>


</form>
@stop
