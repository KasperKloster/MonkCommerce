@include('monkcommerce::monkcommerce-storefront.layouts.partials._head')
@include('monkcommerce::monkcommerce-storefront.layouts.partials._navbar')
<main class="pb-5">
  <div class="container my-5">
  <!-- Messages -->
  @include('monkcommerce::monkcommerce-storefront.layouts.partials._messages')
  @yield('content')
  </div>
</main>
@include('monkcommerce::monkcommerce-storefront.layouts.partials._footer')
