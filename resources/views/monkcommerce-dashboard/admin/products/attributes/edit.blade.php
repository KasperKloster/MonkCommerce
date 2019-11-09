@section('page-title')
  EDIT | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-form')

@section('page-content')
<form action="{{ route('monk-admin-products-attr-update', $attr->id) }}" method="post">
  <div class="card">
    <div class="card-header">
      Edit Attr
    </div>
    <div class="card-body">
      @csrf
      <div class="form-group">
        <label for="attrName">{{ ucwords(__('monkcommerce-dashboard.general-words.name')) }}</label>
        <input type="text" class="form-control" id="attrName" name="attrName" value="{{ $attr->name }}" required>
      </div>

      <div class="form-group">
        @forelse($attr->attributeValues as $val)
          <input type="hidden" class="form-control" name="oldAttrValueId[]" value="{{ $val->id }}" required>
        @empty
          <input type="hidden">
        @endforelse
        <div id="valueGroup">
          @forelse($attr->attributeValues as $val)
          <div class="form-row mt-1">
            <div class="col-md-1"></div>
              <div class="col">
                <input type="text" class="form-control" id="attrValueName" name="attrValueId[{{ $val->id }}]" value="{{ $val->value }}" required>
                <input type="hidden" class="form-control" id="attrValueName" name="exValueId[]" value="{{ $val->id }}" required>
              </div>
              <div class="col">
                <button class="btn btn-primary addBtn">Add</button>
                <button class="btn btn-warning removeBtn">Remove</button>
              </div>
          </div>
          @empty
          <div class="form-row">
            <div class="col-md-1"></div>
            <div class="col">
              <input type="text" class="form-control" id="newAttrValue" name="newAttrValue[]" placeholder="Value" required>
            </div>
            <div class="col">
              <button class="btn btn-primary addBtn">Add</button>
              <button class="btn btn-warning removeBtn">Remove</button>
            </div>
          </div>
          @endforelse
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
    target.append("<div class='form-row mt-2'><div class='col-md-1'></div><div class='col'><input type='text' class='form-control' id='newAttrValue' name='newAttrValue[]' placeholder='Value' required></div><div class='col'><button class='btn btn-primary addBtn mr-1'>Add</button><button class='btn btn-warning removeBtn'>Remove</button></div></div>");
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
