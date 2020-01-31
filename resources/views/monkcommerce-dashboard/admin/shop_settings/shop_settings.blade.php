@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.left-panel.shop_settings')) }}
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-form')

@section('header')
  {{ ucwords(__('monkcommerce-dashboard.left-panel.shop_settings')) }}
@stop

@section('page-content')

<form action="{{ route('shop-setting.store') }}" method="post">
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
            <label for="name">{{ ucwords(__('monkcommerce-dashboard.shop-information.shop_name')) }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $shop->name }}">

          </div>

          <div class="form-group">
            <label for="street_address">{{ ucwords(__('monkcommerce-dashboard.shop-information.street_address')) }}</label>
            <input type="text" class="form-control @error('street_address') is-invalid @enderror" id="street_address" name="street_address" value="{{ $shop->street_address }}">
            @error('street_address')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group row">
            <div class="col">
              <label for="postal_code">{{ ucwords(__('monkcommerce-dashboard.shop-information.postal_code')) }}</label>
              <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ $shop->postal_code }}">
              @error('postal_code')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="col">
              <label for="city">{{ ucwords(__('monkcommerce-dashboard.shop-information.city')) }}</label>
              <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ $shop->city }}">
              @error('city')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="col">
              <label for="country">{{ ucwords(__('monkcommerce-dashboard.shop-information.country')) }}</label>
              <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ $shop->country }}">
              @error('country')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>

        <div class="form-group row">
          <div class="col">
            <label for="phone">{{ ucwords(__('monkcommerce-dashboard.shop-information.phone')) }}</label>
            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $shop->phone }}">
            @error('phone')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="col">
            <label for="email">{{ ucwords(__('monkcommerce-dashboard.shop-information.email')) }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $shop->email }}">
            @error('email')
              <small class="text-danger">{{ $message }}</small>
            @enderror
            <small id="emailHelp" class="form-text text-muted">{{ ucfirst(__('monkcommerce-dashboard.shop-information.emailHelp')) }}</small>
          </div>
          <div class="col">
            <label for="url">{{ ucwords(__('monkcommerce-dashboard.shop-information.url')) }}</label>
            <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ $shop->url }}">
            @error('url')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <div class="form-group">
          <label for="vat_number">{{ ucwords(__('monkcommerce-dashboard.shop-information.vat_number')) }}</label>
          <input type="text" class="form-control @error('vat_number') is-invalid @enderror" id="vat_number" name="vat_number" value="{{ $shop->vat_number }}">
          @error('vat_number')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <hr/>
        <div class="form-group row">
          <div class="col">
            <label for="currency">Currency</label>
            <input type="text" class="form-control @error('currency') is-invalid @enderror" id="currency" name="currency" value="{{ $shop->currency }}" required>
            @error('currency')
              <small class="text-danger">{{ $message }}</small>
            @enderror
            <small id="helpCurrency" class="form-text text-muted">The price displayed on the shop pages.</small>
          </div>

          <div class="col">
            <label for="schema_currency">Schema Currency</label>
            <input type="text" class="form-control @error('schema_currency') is-invalid @enderror" id="schema_currency" name="schema_currency" value="{{ $shop->schema_currency }}" required>
            @error('schema_currency')
              <small class="text-danger">{{ $message }}</small>
            @enderror
            <small id="helpSchema_currency" class="form-text text-muted"><a href="https://en.wikipedia.org/wiki/ISO_4217" target="_blank">ISO 4217 standard currency format.</a></small>
          </div>
        </div>

        <div class="form-group">
          <label for="payment_api_key">Payment API</label>
          <input type="text" class="form-control @error('payment_api_key') is-invalid @enderror" id="payment_api_key" name="payment_api_key" value="{{ $shop->payment_api_key }}">
        </div>

        <hr/>
        <div class="form-group">
          <label for="prefix">Prefix</label>
          <input type="text" class="form-control @error('prefix') is-invalid @enderror" id="prefix" name="prefix" value="{{ $shop->prefix }}">
          @error('prefix')
            <small class="text-danger">{{ $message }}</small>
          @enderror
          <small id="helpPrefix" class="form-text text-muted">Will be shown at page titles on all shop pages (categories and products) Eg. | {{ $shop->shop_name }}</small>
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
        <label for="cookie_msg">Message</label>
          <textarea class="form-control @error('description') is-invalid @enderror" name="cookie_msg" id="cookie_msg" rows="3">{{ $shop->cookie_msg }}</textarea>
          @error('cookie_msg')
            <small class="text-danger">{{ $message }}</small>
          @enderror
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
