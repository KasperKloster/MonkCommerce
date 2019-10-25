@include('monkcommerce::monkcommerce-storefront.layouts.partials._head')
  <!-- Navbar -->
  @include('monkcommerce::monkcommerce-storefront.layouts.partials._navbar')

  <main>
    @yield('content')
  </main>

@include('monkcommerce::monkcommerce-storefront.layouts.partials._footer')
