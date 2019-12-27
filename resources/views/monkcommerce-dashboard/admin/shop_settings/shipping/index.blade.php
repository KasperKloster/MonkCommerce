@section('page-title')
  Shipping Settings | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-index')

@section('header')
<h1>Shipping Settings</h1>
@stop

@section('card-btn')
<a href="{{ route('monk-admin-courier-create') }}" class="btn btn-sm btn-success">Create New Shipping</a>
@stop

@section('card-content')
<table class="card-table table table-hover table-responsive-lg">
  <thead>
    <tr>
      <th scope="col">Courier</th>
      <th>Buttons</th>
    </tr>
  </thead>
  <tbody>

      @foreach($couriers as $courier)
      <tr>
        <td>{{ $courier->courier }}</td>
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <!-- Edit -->
            <a href="{{ route('monk-admin-courier-edit', $courier->id) }}" class="btn btn-sm btn-info mat-inline-center">
              <i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}
            </a>
            <!-- Delete -->
            <a href="{{ route('monk-admin-courier-destroy', $courier->id) }}" class="btn btn-sm btn-danger mat-inline-center">
              <i class="material-icons">delete_forever</i> {{ ucwords(__('monkcommerce-dashboard.general-words.delete')) }}
            </a>
          </div>
        </td>
      </tr>
      @endforeach

  </tbody>
</table>
@stop
