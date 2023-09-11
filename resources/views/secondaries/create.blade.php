@extends('layouts.defaultAdmin')
@section('content')
<br>
<div class="container">
  <div class="row justify-content-center">
    @if (Session::has('success'))
    <div class="alert alert-success">
      {{ Session::get('success') }}
    </div>
    @endif
    <br>
    <div class="row">
      <div class="col-lg-12">
        <div class="e-panel card">
          <div class="card-header">{{ __('Add Secondary') }} <a href="{{ url('/secondaries/index') }}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="fa-brands fa-primaries-hunt"></i>Secondary</a></div>
          <div class="card-body">
            <form method="POST" action="{{ route('primaries.store') }}" enctype="multipart/form-data">
              @csrf      
              <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 form-group">
                      <label for="exampleInputEmail1">Choose Product with Batch Number</label>
                      <select name="labelid" id="labelid" class="form-control">
                        <option value="">Choose Product with Batch Number</option>
                        @foreach ($primaries as $primary)
                          <option value="{{ $primary->Product->id }}">{{ $primary->Product->ProductName }} ({{ $primary->BatchNumber }}) ({{ date('d-M-Y h:i:s a', strtotime($primary->created_at)) }})</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-lg-6 form-group">
                      <label for="">Total No. of Primary Labels Available</label>
                      <input type="text" class="form-control" id="quantity"
                            placeholder="" name="quantity" readonly>
                    </div>
                    <div class="col-lg-6 form-group">
                      <label for="">Required No. of Primary Labels in One Secondary </label>
                      <input type="text" class="form-control" id=""
                            placeholder="Enter Quantity" name="label_numbers">
                    </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div> 
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#labelid').change(function() {
      var id = $(this).val();
      $.ajax({
        url: '/get-srelated-data',
        type: "GET",
        data: {
          id: id,
        },
        success: function(data, textStatus, jqXHR) {
          if (data) {
            $('#quantity').val(data[0]['quantity']);
          } 
        },
        error: function(jqXHR, textStatus, errorThrown) {
        }
      });
    })
  })
</script>
@endsection