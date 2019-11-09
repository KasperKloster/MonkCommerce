@include('monkcommerce::monkcommerce-dashboard.layouts.partials._head')
  <!-- Navbar -->
  @include('monkcommerce::monkcommerce-dashboard.layouts.partials._navbar')
  <!-- Left-panel / Sidebar -->
  @include('monkcommerce::monkcommerce-dashboard.layouts.partials._left-panel')
  <!-- Content / Right Panel -->
  <div id="right-panel" class="right-panel">
    <!-- Content -->
    <div class="content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </div> <!-- ./content -->
  </div> <!-- ./right-panel -->

  <!-- Footer -->
  <footer>
    <div class="nav justify-content-end">
      <small class="text-muted"><i>Made by <a href="https://kasperkloster.dk" target="_blank">Kasper Kloster</a> at <a href="https://onlinemind.dk" target="_blank">OnlineMind</a></i></small>
    </div>
  </footer>
@include('monkcommerce::monkcommerce-dashboard.layouts.partials._footer')
