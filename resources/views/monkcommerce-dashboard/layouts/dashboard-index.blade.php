@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-main')

@section('content')
<!-- Header -->
<h1>@yield('header')</h1>
<!-- Messages -->
@include('monkcommerce::monkcommerce-dashboard.layouts.partials._messages')

<!-- Page Content -->
<div class="row">
  <div class="col-md-12">
    <!-- Table Header -->
    <div class="card">
      <div class="card-header">
        <div class="nav justify-content-end">
          @yield('card-btn')
        </div>
      </div>
      @yield('card-content')
    </div> <!-- /.card -->
  </div> <!-- /.col-md-12 -->
</div> <!-- /. row -->

@stop
