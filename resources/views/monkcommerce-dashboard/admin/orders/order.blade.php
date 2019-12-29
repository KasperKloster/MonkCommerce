@section('page-title')
  Order - (ID: {{$order->id}}) | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-form')


@section('header')
  Order (ID: {{$order->id}})
@stop

@section('page-content')
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
                <td>Date</td>
              </tr>
              <tr>
                <th scope="row">Order Status</th>
                <td>Status</td>
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
                <td>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td>{{ $order->customer->email }}</td>
              </tr>
              <tr>
                <th scope="row">Phone</th>
                <td>{{ $order->customer->phone }}</td>
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
                <td>{{ucwords($order->customer->first_name . ' ' . $order->customer->last_name)}}</td>
              </tr>
              <tr>
                <td>{{ ucwords($order->customer->street_address) }}</td>
              </tr>
              <tr>
                <td>{{ ucwords($order->customer->postal_code . ' ' . $order->customer->city) }}</td>
              </tr>
              <tr>
                <td>{{ ucwords($order->customer->country) }}</td>
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
                <td>{{ucwords($order->customer->first_name . ' ' . $order->customer->last_name)}}</td>
              </tr>
              <tr>
                <td>{{ ucwords($order->customer->street_address) }}</td>
              </tr>
              <tr>
                <td>{{ ucwords($order->customer->postal_code . ' ' . $order->customer->city) }}</td>
              </tr>
              <tr>
                <td>{{ ucwords($order->customer->country) }}</td>
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
                    <td>{{ showPrice(10) }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Shipping</th>
                    <td>{{ showPrice(5) }}</td>
                  </tr>
                  <tr class="underline">
                    <th scope="row">Subtotal</th>
                    <td><b>{{ showPrice(15) }}</b></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Status -->
          <div class="card border-light">
            <div class="card-body">
              <form>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Order Status</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- /. p-3 -->

  <!-- Card Footer -->
  <div class="card-footer">
    <div class="row justify-content-end">
      <button class="btn btn-success" type="submit">Save Order</button>
    </div>
  </div>

</div> <!-- /. card -->

@stop
