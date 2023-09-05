@extends('layouts.defaultAdmin')
@section('content')
<br>
  <div class="container">
    <div class="row justify-content-center">
        @if ( Session::has('success') )
         <div class="alert alert-success">
          {{ Session::get('success') }}
         </div>
        @endif
  <br>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">{{ __('Add Permission') }}  <a href="{{ route('permissions.index') }}" style="position: absolute;right: 10px;"class="btn btn-primary btn-sm"><i class="fa-solid fa-ticket"></i>Permission List</a></div>

                <div class="card-body">
                  <form method="POST" action="{{ route('permissions.store') }}" enctype="multipart/form-data">
                    @csrf
                      <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end"> 
                          {{ __('Name') }}
                        </label>
                          <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                              @error('name')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                          </div>
                      </div>

                      <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                          <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i>
                            {{ __('Add Permission') }}
                          </button>
                        </div>
                      </div>
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </div>
  <br>
  <br>
<script>
    // function updateRouteId() {
    //     var busId = $("#bus_id").val();
    //     $.ajax({
    //         url: "{{ url('buss') }}/" + busId + "/route-id",
    //         type: "GET",
    //         dataType: "json", 
    //         success: function(data) { 
    //             $("#route_id").val(data.route_id);
    //             $("#route_name").val(data.route_name);
    //         },
    //         error: function(xhr, status, error) { 
    //             alert("An error occurred: " + error);
    //         }
    //     });
    // }
    // $("#bus_id").change(updateRouteId);
</script>
@endsection


