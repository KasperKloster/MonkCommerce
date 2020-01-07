<div class="checkout-list-steps">
  <ul class="d-flex list-unstyled">

    <li>
      <a class="text-decoration-none" href="{{ route('monk-shop-checkout-billing') }}">
      <div class="checkout-step">
        <div class="checkout-step-number step-color-active">
          1
        </div>
        <div class="checkout-step-text" data-text="Adresss">
          Address
        </div>
      </div>
      </a>
    </li>

    <div class="checkout-step-divider"></div>

    <li>
      <div class="checkout-step">
        <div class="checkout-step-number @if($step2 == TRUE) step-color-active @else step-color-default @endif">
          2
        </div>
        <div class="checkout-step-text" data-text="Adresss">
          Delivery
        </div>
      </div>
    </li>

    <div class="checkout-step-divider"></div>

    <li>
      <div class="checkout-step">
        <div class="checkout-step-number @if($step3 == TRUE) step-color-active @else step-color-default @endif">
          3
        </div>
        <div class="checkout-step-text" data-text="Adresss">
          Payment
        </div>
      </div>
    </li>

  </ul>
</div>
