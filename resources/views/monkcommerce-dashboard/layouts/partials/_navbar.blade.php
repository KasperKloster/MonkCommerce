<nav class="navbar navbar-expand-lg navbar-light admin-navbar">
  <a class="navbar-brand" href="{{ route('monk-admin-home') }}">Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link mat-inline-center" href="{{ route('monk-shop-index') }}" target="_blank">
          Back to Shop<i class="material-icons">open_in_new</i>
        </a>
      </li>
    </ul>

    <!-- Login / admin -->
    <ul class="nav justify-content-end">
      @include('monkcommerce::monkcommerce-shared.partials._navbar-admin')
    </ul>

  </div>
</nav>
