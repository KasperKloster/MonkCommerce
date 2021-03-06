@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-main')

@section('content')
<!-- breadcrumb -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page">
      <a class="mat-inline-center text-decoration-none" href="{{ URL::previous() }}"><i class="material-icons">keyboard_backspace</i> {{ ucwords(__('monkcommerce-dashboard.general-words.back')) }}</a>
    </li>
  </ol>
</nav>
<!-- Header -->
<h1>@yield('header')</h1>
<!-- Messages -->
@include('monkcommerce::monkcommerce-dashboard.layouts.partials._messages')

<!-- Page Content -->
<section>
  @yield('page-content')
</section>

@stop
