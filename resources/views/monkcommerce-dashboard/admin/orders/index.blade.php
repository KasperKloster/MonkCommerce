@section('page-title')
  Orders | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-index')

@section('header')
<h1>Orders</h1>
@stop

@section('card-content')
<table class="card-table table table-hover table-responsive-lg">
  <thead>
    <tr>
      <th scope="col">Order id</th>
      <th scope="col">Name</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>
      <th>Buttons</th>
    </tr>
  </thead>
  <tbody>
    @foreach($orders as $order)
    <tr>
      <td>
        <a href="{{ route('monk-admin-orders-order', $order->id) }}">{{ $order->id }}</a>
      </td>

      <td>First and Last Name</td>
      <td>Date</td>
      <td class="text-success">
        <div class="badge badge-success text-wrap">
        Status
        </div>
      </td>

      <td>
        <div class="btn-group" role="group" aria-label="Basic example">
          <!-- View -->
          <a href="{{ route('monk-admin-orders-order', $order->id) }}" class="btn btn-sm btn-info mat-inline-center">
            View
          </a>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="card-footer d-flex justify-content-center">
  {{ $orders->links() }}
</div>
@stop
