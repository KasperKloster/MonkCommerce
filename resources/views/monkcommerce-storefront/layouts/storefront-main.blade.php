@include('monkcommerce::monkcommerce-storefront.layouts.partials._head')
@include('monkcommerce::monkcommerce-storefront.layouts.partials._navbar')
<main>
  <div class="container">
  <!-- Messages -->
  @include('monkcommerce::monkcommerce-storefront.layouts.partials._messages')
  @yield('content')
  </div>
</main>
@include('monkcommerce::monkcommerce-storefront.layouts.partials._footer')
