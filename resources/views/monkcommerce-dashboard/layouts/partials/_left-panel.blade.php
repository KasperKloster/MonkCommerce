<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
  <nav class="navbar">

    <div class="sidebar-menu-header">
      <span class="menu-title">
        <a class="text-decoration-none" href="{{route('monk-admin-home')}}">Dashboard</a>
      </span>
    </div>
    <ul id="sidebar-menu" class="list-unstyled">
      <li class="menu-title">{{ ucwords(__('monkcommerce-dashboard.left-panel.categories')) }}</li>
      <li>
        <a href="{{ route('monk-admin-categories-home') }}">
          {{ ucwords(__('monkcommerce-dashboard.categories.all_categories')) }}<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>

      <li class="menu-title">{{ ucwords(__('monkcommerce-dashboard.left-panel.products')) }}</li>
      <li>
        <a href="{{ route('monk-admin-products-home') }}">
          {{ ucwords(__('monkcommerce-dashboard.left-panel.all_products')) }}<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>

      <li>
        <a href="{{ route('monk-admin-products-attr-home') }}">
          {{ ucwords(__('monkcommerce-dashboard.left-panel.product_attributes')) }}<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>

      <li class="menu-title">{{ ucwords(__('monkcommerce-dashboard.left-panel.orders')) }}</li>
      <li>
        <a href="{{ route('monk-admin-orders-index') }}">
          All Orders <span class="badge badge-success">@if($newLeftPanelOrders >= 1){{ $newLeftPanelOrders }} New @endif</span> <i class="material-icons float-right">chevron_right</i>
        </a>
      </li>
      <li class="menu-title">{{ ucwords(__('monkcommerce-dashboard.left-panel.settings')) }}</li>
      <li>
        <a href="{{ route('monk-admin-shop-settings') }}">
          {{ ucwords(__('monkcommerce-dashboard.left-panel.shop_settings')) }}<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>

      <li>
        <a href="{{ route('courier.index') }}">
          Shipping Settings<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>

      <li class="menu-title">{{ ucwords(__('monkcommerce-dashboard.left-panel.pages')) }}</li>
      <li>
        <a href="{{ route('monk-admin-pages-index') }}">
          {{ ucwords(__('monkcommerce-dashboard.pages.all_pages')) }}<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>
    </ul>
  </nav>
</aside>
