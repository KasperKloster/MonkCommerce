@include('monkcommerce::monkcommerce-storefront.layouts.partials._head')
@include('monkcommerce::monkcommerce-storefront.layouts.partials._navbar')
<main class="pb-5">
  <div class="container my-4">
    <div class="row border-bottom mb-4">
      <div class="col-md-12">
      @yield('header')
      <!-- Messages -->
      @include('monkcommerce::monkcommerce-storefront.layouts.partials._messages')
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <aside class="vh-100 border-right">
          <h5 class="text-center">Filter</h5>
          @yield('filter')
        <aside>
      </div>
      <div class="col-md-9">
        @yield('content')
      </div>
    </div>
  </div><!-- /.container -->
</main>
@include('monkcommerce::monkcommerce-storefront.layouts.partials._footer')
