@section('page-title')
  Order - (ID: {{ $order->id }}) | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-form')


@section('header')
  Order (ID: {{ $order->id }})
@stop

@section('page-content')
<form action="{{ route('monk-admin-orders-update', $order->id) }}" method="post">
  @csrf
  <div class="card">
    <div class="p-3">
      <!-- First info -->
      <div class="card-deck mb-3">
        <div class="card">
          <div class="card-header">
            Order
          </div>
          <div class="card-body p-0">
            <table class="table table-striped table-hover table-sm">
              <tbody>
                <tr>
                  <th scope="row">Order Date</th>
                  <td>{{ $order->created_at }}</td>
                </tr>
                <tr>
                  <th scope="row">Order Last Update</th>
                  <td>{{ $order->updated_at }}</td>
                </tr>
                <tr>
                  <th scope="row">Order Status</th>
                  <td>
                    {{ $order->orderStatus->status }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Customer -->
        <div class="card">
          <div class="card-header">
            Customer
          </div>
          <div class="card-body p-0">
            <table class="table table-striped table-hover table-sm">
              <tbody>
                <tr>
                  <th scope="row">Name</th>
                  <td>{{ $order->orderCustomer->first_name }} {{ $order->orderCustomer->last_name }}</td>
                </tr>
                <tr>
                  <th scope="row">Email</th>
                  <td>{{ $order->orderCustomer->email }}</td>
                </tr>
                <tr>
                  <th scope="row">Phone</th>
                  <td>{{ $order->orderCustomer->phone }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div> <!-- /.card-deck -->

      <!-- Address -->
      <div class="card-deck mb-3">
        <!-- Billing Address -->
        <div class="card">
          <div class="card-header">
            Billing Address
          </div>
          <div class="card-body">
            <table class="table table-borderless table-hover table-sm">
              <tbody>
                <tr>
                  <td>{{ ucwords($order->orderCustomer->first_name . ' ' . $order->orderCustomer->last_name) }}</td>
                </tr>
                <tr>
                  <td>{{ ucwords($order->orderCustomer->street_address) }}</td>
                </tr>
                <tr>
                  <td>{{ ucwords($order->orderCustomer->postal_code . ' ' . $order->orderCustomer->city) }}</td>
                </tr>
                <tr>
                  <td>{{ ucwords($order->orderCustomer->country) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Shipping Address -->
        <div class="card">
          <div class="card-header">
            Shipping Address
          </div>
          <div class="card-body">
            <table class="table table-borderless table-hover table-sm">
              <tbody>
                <tr>
                  <td>{{ucwords($order->orderCustomer->first_name . ' ' . $order->orderCustomer->last_name)}}</td>
                </tr>
                <tr>
                  <td>{{ ucwords($order->orderCustomer->street_address) }}</td>
                </tr>
                <tr>
                  <td>{{ ucwords($order->orderCustomer->postal_code . ' ' . $order->orderCustomer->city) }}</td>
                </tr>
                <tr>
                  <td>{{ ucwords($order->orderCustomer->country) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div> <!-- /.card-deck -->

      <!-- Products -->
      <div class="card mb-3">
        <div class="card-header">
          Products Ordered
        </div>

        <div class="card-content">
          <table class="table table-striped table-hover table-sm">
            <thead>
            <tr>
              <th scope="col">Image</th>
              <th scope="col">SKU</th>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
            </tr>
            </thead>

            <tbody>
              @foreach($order->orderProduct as $product)
              <tr>
                <td>
                  @foreach($product->images as $image)
                    @if ($loop->first)
                    <img src="{{ url('monkcommerce/images/products/' . $image->filename) }}" class="img-fluid img-thumbnail table-image" />
                    @endif
                  @endforeach
                </td>
                <td>{{ $product->sku }}</td>
                <td><a href="{{ route('monk-admin-edit-product', $product->id) }}">{{ $product->name }}</a></td>
                <td>{{ showPrice(($product->special_price ? $product->special_price : $product->price)) }}</td>
                <td>{{ $product->pivot->qty}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>

      <!-- Order Total -->
      <div class="card">
        <div class="card-header">
          Order Total
        </div>
        <div class="card-body p-0">
          <div class="card-group">
            <div class="card border-light">
              <div class="card-body">
                <table class="table table-borderless table-hover table-sm">
                  <tbody>
                    <tr>
                      <th scope="row">Total</th>
                      <td>{{ showPrice($productPrice) }}</td>
                    </tr>
                    <tr>
                      <th scope="row">Shipping</th>
                      <td>{{ showPrice($order->shipping) }}</td>
                    </tr>
                    <tr class="underline">
                      <th scope="row">Subtotal</th>
                      <td><b>{{ showPrice($productPrice + $order->shipping) }}</b></td>
                    </tr>
                    <tr>
                    PAYED NOT PAYED
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>

            <!-- Status -->
            <div class="card border-light">
              <div class="card-body">
                <div class="form-group">
                  <label for="statusSelect">Order Status</label>
                    <select class="form-control" id="statusSelect" name="status">
                      @foreach($status as $stat)
                        <option value="{{ $stat->id }}"
                        @if($order->orderStatus->id == $stat->id)
                          selected
                        @endif
                        >{{ $stat->status }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /. p-3 -->

    <!-- Card Footer -->
    <div class="card-footer">
      <div class="row justify-content-end">
        <button class="btn btn-success" type="submit">Update Order</button>
      </div>
    </div>

  </div> <!-- /. card -->
</form>

@stop
