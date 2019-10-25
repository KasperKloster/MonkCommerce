<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
  <nav class="navbar">


    <ul id="sidebar-menu" class="list-unstyled">
      <div class="sidebar-menu-header">
        Dashboard
      </div>

      <li class="menu-title">{{ __('monkcommerce-dashboard.left-panel.categories') }}</li>
      <li>
        <a href="{{ route('monk-admin-categories-home') }}">
          {{ ucwords(__('monkcommerce-dashboard.left-panel.categories')) }}<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>

      <li class="menu-title">{{ ucwords(__('monkcommerce-dashboard.left-panel.products')) }}</li>
      <li>
        <a href="{{ route('monk-admin-products-home') }}">
          {{ ucwords(__('monkcommerce-dashboard.left-panel.all_products')) }}<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>

      <li>
        <a href="{{ route('monk-admin-create-product') }}">
          {{ ucwords(__('monkcommerce-dashboard.left-panel.product_attributes')) }}<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>

      <li class="menu-title">{{ ucwords(__('monkcommerce-dashboard.left-panel.users')) }}</li>
      <li>
        <a href="#">
          Lorem Ipsum<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>
      <li>
        <a href="#">
          Lorem Ipsum<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>

      <li class="menu-title">{{ ucwords(__('monkcommerce-dashboard.left-panel.customers')) }}</li>
      <li>
        <a href="#">
          Lorem Ipsum<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>
      <li>
        <a href="#">
          Lorem Ipsum<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>
      <!-- -->
      <li class="menu-title">{{ ucwords(__('monkcommerce-dashboard.left-panel.orders')) }}</li>
      <li>
        <a href="#">
          Lorem Ipsum<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>
      <li>
        <a href="#">
          Lorem Ipsum<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>
      <li class="menu-title">{{ ucwords(__('monkcommerce-dashboard.left-panel.settings')) }}</li>
      <li>
        <a href="{{ route('monk-admin-shop-settings') }}">
          {{ ucwords(__('monkcommerce-dashboard.left-panel.shop_settings')) }}<i class="material-icons float-right">chevron_right</i>
        </a>
      </li>
    </ul>
  </nav>
</aside>
