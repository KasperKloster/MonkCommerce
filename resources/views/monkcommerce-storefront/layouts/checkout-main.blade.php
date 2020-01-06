@include('monkcommerce::monkcommerce-storefront.layouts.partials._head')
@include('monkcommerce::monkcommerce-storefront.layouts.partials._navbar')
<main>
  <div class="container-fluid">
      <div class="row d-md-flex flex-md-equal">
          <div class="col-lg-8 col-xs-12 col-lg-offset-1 bg-white vh-100 border-right">
            <div class="container">
              <!-- Messages -->
              @include('monkcommerce::monkcommerce-storefront.layouts.partials._messages')
              @yield('left')
            </div>
          </div>
          <div class="col-lg-4 col-xs-12 cart-sidebar">
            <div class="container">
              @yield('right')
            </div>
          </div>
      </div><!--  .row -->
  </div><!--  .container-fluid -->
</main>
@include('monkcommerce::monkcommerce-storefront.layouts.partials._footer')
