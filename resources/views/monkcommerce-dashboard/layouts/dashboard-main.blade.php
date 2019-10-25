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
      <!-- Footer -->
      <footer>
        <div class="nav justify-content-end">
          <small class="text-muted"><i>Made by Kaspers Kloster at OnlineMind</i></small>
        </div>
      </footer>
    </div> <!-- ./content -->
  </div> <!-- ./right-panel -->
@include('monkcommerce::monkcommerce-dashboard.layouts.partials._footer')
