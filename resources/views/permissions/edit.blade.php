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
    </div>
  </div>
  <br>    

          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-10">
                <div class="card">
                  <div class="card-header">{{ __('Permission Update') }}  <a href="{{ route('permissions.index') }}" style="position: absolute;right: 10px;"class="btn btn-primary btn-sm"><i class="fa-solid fa-ticket"></i>Permission</a></div>

                  <div class="card-body">
                    <form method="POST" action="{{ route('permissions.update',$permission->id) }}" enctype="multipart/form-data">
                      @csrf
                       @method('put')
                        <div class="row mb-3">
                          <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$permission->name) }}"  autocomplete="name" autofocus>
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
                              {{ __('Permission Update') }}
                            </button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div> 

        <!-- @if($permission->roles->isNotEmpty())
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-10">
                <div class="card">
                  <div class="card-header">{{ __('Permission Has Roles') }}</div>
                    <div class="card-body">
                    @if( $permission->roles )
                      @foreach( $permission->roles as $permission_role )
                      <form id="target" action="{{ route('permissions.roles.remove', [$permission->id, $permission_role->id]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <br>
                      <button  class="btn btn-danger removeRole" onclick="removeRole(id);" type="button">{{ $permission_role->name }}</button>
                      </form>
                      @endforeach
                    @endif
                  </div>
                <div>
              </div>
            </div>
          </div>
          @else
          @endif        

          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-10">
                <div class="card">
                  <div class="card-header">{{ __('Permission Role Add') }}  <a href="{{ route('permissions.index') }}" style="position: absolute;right: 10px;"class="btn btn-primary btn-sm"><i class="fa-solid fa-unlock-keyhole"></i>Permsission</a></div>

                  <div class="card-body">
                    <form method="POST" action="{{ route('permissions.roles',$permission->id) }}" enctype="multipart/form-data">
                      @csrf

                        <div class="row mb-3">
                          <label for="role" class="col-md-4 col-form-label text-md-end"> 
                            {{ __('Role') }}
                          </label>
                          <div class="col-md-6">
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" aria-label=".form-select-lg example">
                              <option disabled selected>Select a Role...</option>
                              @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                              @endforeach
                            </select>
                            @error('role')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          <div>
                             <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">
                             <i class="material-icons" style="font-size:15px">&#xe39d;</i>Add Role</a>
                          </div>  
                        </div>

                        <div class="row mb-0">
                          <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                              <i class="fa-solid fa-briefcase"></i>
                              {{ __('Assign') }}
                            </button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
<script>
function removeRole(id){
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
    text: 'You wont to delete this!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!'
  }).then((result) => {
    if (result.isConfirmed) {
       $( "#target" ).submit();
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      swalWithBootstrapButtons.fire(
        'Cancelled',
        'Role is safe :)',
        'error'
      )
    }
  })
}
</script>
@endsection