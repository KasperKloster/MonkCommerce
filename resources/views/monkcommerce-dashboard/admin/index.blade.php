@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-main')
  @section('page-title')
    {{ $storefrontShop->shop_name }} Dashboard
  @stop

@section('content')
<section class="jumbotron text-center bg-transparent">
  <div class="container">
    <h1>Admin Panel</h1>
    <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
    <p>
      <a href="{{ route('orders.index') }}" class="btn btn-primary my-2">Go to Orders</a>
    </p>
  </div>
</section>

<section>
  <div class="card-deck">
    <!-- New Orders -->
    <div class="card">
      <div class="card-header">
        New Orders
      </div>
      <div class="card-content text-center p-3">
        <h3>{{ $newLeftPanelOrders }}</h3>
        <p class="lead text-muted">New Orders</p>
      </div>
      <div class="card-footer d-flex justify-content-end">
        <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm">Go to Orders</a>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        Pending Orders
      </div>
      <div class="card-content text-center p-3">
        <h3>{{ $pendingOrders }}</h3>
        <p class="lead text-muted">Pending Orders</p>
      </div>
      <div class="card-footer d-flex justify-content-end">
        <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm">Go to Orders</a>
      </div>
    </div>

  </div>
</section>
@stop
