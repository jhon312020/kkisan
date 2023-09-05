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
  </div>
</div>
<br>
<div class="container">
  <div class="row justify-content-center">
    <div class="d-flex justify-content-between py-3"></div>
    <div class="col-md-12">
      <div class="card">
       <!--   @if(  $settings->isEmpty() )
            <div class="card-header">{{ __('Setting List') }}  <a href="{{ route('settings.create') }}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe39d;</i>Add Setting</a></div>
        @else
            <div class="card-header">{{ __('Setting List') }}</div>
        @endif -->
        @if(  $settings->isEmpty() )
            <div class="card-header">{{ __('Setting List') }}  <a href="{{ route('logos.create') }}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe39d;</i>Add Setting</a></div>
        @else
            <div class="card-header">{{ __('Setting List') }}</div>
        @endif
        <div class="card-body">
          <!-- <form method="GET" class="col-6">
            <div class="form-group">
              <input type="search" name="search" value="" class="form-control" placeholder="Search by Position" aria-label="Search" aria-describedby="button-addon2">
            </div>
            <button class="btn btn-primary" type="submit" id="button-addon2"><i class="material-icons" style="font-size:15px">&#xe8b6;</i> Search</button>
            <a href="{{ url('/settingHome') }}">
              <button class="btn btn-primary" type="button"><i class="material-icons" style="font-size:15px">&#xe86a;</i> Reset</button>
            </a>
          </form>
          <br> -->
          <form id="target" action="/delete-settings" method="POST">
            @csrf
            <table class="table table-striped">
              <tr>
          <!--       <th>
                  <div class="form-check form-switch">
                    <input type="checkbox" id="selectAll">
                  </div>
                </th> -->
                <th>Logo</th>
                <th>Fav Icon</th>
                <th>Footer Copyrigh</th>
                <th>Meta Title Home</th>
                <th>Action</th>
              </tr>
              @if ($settings->isNotEmpty())
              @foreach ($settings as $setting)
              <tr valign="middle">
           <!--      <td>
                  <div class="form-check form-switch">
                    <input type="checkbox" class="dynamicCheckbox" name="ids[{{ $setting->id }}]" value="{{ $setting->id }}" id="{{ $setting->id }}">
                  </div>
                </td> -->
                <td><img src="{{asset($setting->logo)}}" style="width:100px; height: 100px;"></td>
                <td><img src="{{asset($setting->favicon)}}" style="width:100px; height: 100px;"></td>
                <td>{{ $setting->footer_copyright}}</td>
                <td>{{ $setting->meta_title_home}}</td>
                <td>
                  <a href="{{ route('logos.edit', $setting->id) }}" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe254;</i> Edit</a>
                  <!-- <a href="{{ route('settings.edit', $setting->id) }}" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe254;</i> Edit</a> -->
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="6">Record Not Found</td>
              </tr>
              @endif
            </table>
            <!-- <button type="button" value="Delete settings" onclick="deletesettings();" class="btn btn-danger" for="Delete settings"><i class="material-icons" style="font-size:15px">&#xe872;</i> Delete Setting</button> -->
          </form>
          <div class="mt-3">
            {{ $settings->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#selectAll').click(function() {
      $('.dynamicCheckbox').prop('checked', $(this).prop('checked'));
    });
    $('.dynamicCheckbox').click(function() {
      if ($('.dynamicCheckbox:checked').length === $('.dynamicCheckbox').length) {
        $('#selectAll').prop('checked', true);
      } else {
        $('#selectAll').prop('checked', false);
      }
    });
  });

  function deletesettings() {
    event.preventDefault();
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    Swal.fire({
      title: 'Are you sure?',
      text: 'You want to delete this!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!'
    }).then((result) => {
      if (result.isConfirmed) {
        $("#target").submit();
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          'setting is safe :)',
          'error'
        )
      }
    })
  }
</script>
@endsection