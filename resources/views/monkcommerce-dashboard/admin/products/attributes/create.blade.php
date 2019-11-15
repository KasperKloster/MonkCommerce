@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.attr.create_new_attr')) }} | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-form')

@section('page-content')
<form action="{{ route('monk-admin-products-attr-store') }}" method="post">
  <div class="card">
    <div class="card-header">
      {{ ucwords(__('monkcommerce-dashboard.attr.create_new_attr')) }}
    </div>
    <div class="card-body">
      @csrf
      <div class="form-group">
        <label for="attrName">{{ ucwords(__('monkcommerce-dashboard.general-words.name')) }}</label>
        <input type="text" class="form-control" id="attrName" name="attrName" value="{{old('attrName')}}" placeholder="{{ ucwords(__('monkcommerce-dashboard.general-words.name')) }}" required>
      </div>

      <div id="valueGroup">
        <div class="form-row">
          <div class="col-md-1"></div>
          <div class="col">
            <input type="text" class="form-control" id="attrValueName" name="attrValueName[]" value="{{old('attrValueName')}}" placeholder="Value" required>
          </div>
          <div class="col">
            <button class="btn btn-primary addBtn">{{ ucwords(__('monkcommerce-dashboard.general-words.add')) }}</button>
            <button class="btn btn-warning removeBtn">{{ ucwords(__('monkcommerce-dashboard.general-words.remove')) }}</button>
          </div>
        </div>
      </div>

    </div>

    <div class="card-footer">
      <div class="form-group row pt-3">
        <div class="col">
          <button class="btn btn-success" type="submit">{{ ucwords(__('monkcommerce-dashboard.general-words.save')) }}</button>
          <button class="btn btn-outline-secondary" type="reset">{{ ucwords(__('monkcommerce-dashboard.general-words.reset')) }}</button>
        </div>
      </div>
    </div>
  </div>
</form>
@stop

@section('scripts')
<script>

// Add Btn
$(function($) {
  $(document).on('click', '.addBtn', function(event) {
    event.preventDefault();
    var target = $(event.target).closest('#valueGroup');
    target.append("<div class='form-row mt-2'><div class='col-md-1'></div><div class='col'><input type='text' class='form-control' id='attrValueName' name='attrValueName[]' placeholder='Value' required></div><div class='col'><button class='btn btn-primary addBtn mr-1'>Add</button><button class='btn btn-warning removeBtn'>Remove</button></div></div>");
  });
});
// Remove BTN
$(function($) {
  $(document).on('click', '.removeBtn', function(event) {
    event.preventDefault();
    var target = $(event.target).closest('.form-row').remove();
  });
});
</script>

@stop
