@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.categories.create_new_category')) }} | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-form')


@section('page-content')
<form action="{{ route('monk-admin-courier-update', $courier->id) }}" class="needs-validation" method="post">
  @csrf
  <div class="card">
    <div class="card-header">
    Edit Courier
    </div>

    <div class="card-body">

      <div class="form-group">
        <label for="courierName">Courier Name</label>
        <input type="text" class="form-control" name="courierName" id="courierName" value="{{ $courier->courier }}" required>
      </div>


    </div>
    <div class="card-footer">
      <div class="form-group row pt-3">
        <div class="col">
          <button class="btn btn-success" type="submit">{{ ucwords(__('monkcommerce-dashboard.general-words.save')) }}</button>
          <input class="btn btn-warning" type="reset" value="{{ ucwords(__('monkcommerce-dashboard.general-words.reset')) }}" />
        </div>
      </div>
    </div>
  </div>
</form>
@stop