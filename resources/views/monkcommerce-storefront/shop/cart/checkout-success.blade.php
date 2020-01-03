@extends('monkcommerce::monkcommerce-storefront.layouts.storefront-main')
  @section('page-title')
    Success
  @stop
  @section('seo-robots')
    <meta name="robots" content="noindex, nofollow">
  @stop

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>Purchace Success</h2>
      <p class="lead d-block">Hi {{ $dbOrder->orderCustomer->first_name }}, Your Purchase was completed successfully.</p>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <p>
      We have registred your order with the ordernumber: {{$dbOrder->id}}<br/>
      We have send you an email at {{ $dbOrder->orderCustomer->email }}.<br/>
      As soon as we have packed your order and sent to your address, you will recived an e-mail<br/>
      </p>
    </div>
  </div>

  <!-- Products -->
  <div class="card mb-3">
    <div class="card-header">
      Products Ordered
    </div>

    <div class="card-content">
      <table class="table table-striped table-hover table-sm">
        <tbody>
          @foreach($dbOrder->orderProduct as $product)
          <tr>
            <td>
              @foreach($product->images as $image)
                @if ($loop->first)
                <img src="{{ url('monkcommerce/images/products/' . $image->filename) }}" class="img-fluid img-thumbnail table-image" />
                @endif
              @endforeach
            </td>
            <td>{{ $product->sku }}</td>
            <td><a href="{{ route('monk-shop-single-product', $product->slug) }}" target="_blank">{{ $product->name }}</a></td>
            <td>{{ $product->pivot->qty}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- -->


</div>
@stop
