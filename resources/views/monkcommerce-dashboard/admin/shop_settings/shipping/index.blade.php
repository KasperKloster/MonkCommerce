@section('page-title')
  Shipping Settings | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-index')

@section('header')
<h1>Shipping Settings</h1>
@stop

@section('card-btn')
<a href="#" class="btn btn-sm btn-success">Create New Shipping</a>
@stop

@section('card-content')
<table class="card-table table table-hover table-responsive-lg">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">SKU</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Special Price</th>
      <th scope="col">Quantity</th>
      <th>Buttons</th>
    </tr>
  </thead>
  <tbody>

      <tr>
        <td>#</td>
        <td>#</td>
        <td>#</td>
        <td>#</td>
        <td>#</td>
        <td>#</td>
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <!-- edit -->
            <a href="#" class="btn btn-sm btn-info mat-inline-center">
              <i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}
            </a>
            <!-- show in shop -->
            <a href="#" class="btn btn-sm btn-outline-secondary mat-inline-center" target="_blank">
              {{ ucwords(__('monkcommerce-dashboard.general-words.show_in_shop')) }}<i class="material-icons">open_in_new</i>
            </a>
            <!-- Delete Category -->
            <a href="#" class="btn btn-sm btn-danger mat-inline-center">
              <i class="material-icons">delete_forever</i> {{ ucwords(__('monkcommerce-dashboard.general-words.delete')) }}
            </a>
          </div>
        </td>
      </tr>

  </tbody>
</table>
@stop
