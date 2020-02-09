@auth
<li class="nav-item dropleft">
  <a class="nav-link " href="#" id="loginDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="material-icons">account_circle</i>
  </a>
  <!-- Dropdown Menu -->
  <div class="dropdown-menu" aria-labelledby="loginDropdown">
    <a class="dropdown-item" href="{{ route('monk-admin-home') }}">
      <div class="mat-inline-center">
        <i class="material-icons mr-2">dashboard</i> Dashboard
      </div>
    </a>

    <a class="dropdown-item" href="{{ route('orders.index') }}">
      <div class="mat-inline-center">
        <i class="material-icons mr-2">label</i> Orders <span class="badge badge-success ml-1">@if($newLeftPanelOrders >= 1){{ $newLeftPanelOrders }} New @endif</span>
      </div>
    </a>

    <div class="dropdown-divider"></div>

    <div class="dropdown-item sidebar-menu-header">
      <form action="{{ route('logout')}}" method="post">
        @csrf
        <button type="submit" class="btn btn-link">Logout</button>
      </form>
     </div>
  </div>
</li>
@endauth
