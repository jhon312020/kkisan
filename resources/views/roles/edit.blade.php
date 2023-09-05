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
                  <div class="card-header">{{ __('Role Update') }}  <a href="{{ route('roles.index') }}" style="position: absolute;right: 10px;"class="btn btn-primary btn-sm"><i class="fa-solid fa-unlock-keyhole"></i>Role</a></div>

                  <div class="card-body">
                    <form method="POST" action="{{ route('roles.update',$role->id) }}" enctype="multipart/form-data">
                      @csrf
                       @method('put')
                        <div class="row mb-3">
                          <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$role->name) }}"  autocomplete="name" autofocus>
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
                              {{ __('Name Update') }}
                            </button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- @if($role->permissions->isNotEmpty())
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-10">
                <div class="card">
                  <div class="card-header">{{ __('Role Has Permissions') }}</div>
                    <div class="card-body">
                    @if( $role->permissions )
                      @foreach( $role->permissions as $role_permission )
                      <form id="target" action="{{ route('roles.permissions.revoke', [$role->id, $role_permission->id]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <br>
                      <button  class="btn btn-danger revokePermission" onclick="revokePermission(id);" type="button">{{ $role_permission->name }}</button>
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
                  <div class="card-header">{{ __('Role Permission Add') }}  <a href="{{ route('roles.index') }}" style="position: absolute;right: 10px;"class="btn btn-primary btn-sm"><i class="fa-solid fa-unlock-keyhole"></i>Role</a></div>

                  <div class="card-body">
                    <form method="POST" action="{{ route('roles.permissions',$role->id) }}" enctype="multipart/form-data">
                      @csrf

                        <div class="row mb-3">
                          <label for="permission" class="col-md-4 col-form-label text-md-end"> 
                            {{ __('Permission') }}
                          </label>
                          <div class="col-md-6">
                            <select name="permission" id="permission" class="form-control @error('permission') is-invalid @enderror" aria-label=".form-select-lg example">
                              <option disabled selected>Select a Permission...</option>
                              @foreach($permissions as $permission)
                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                              @endforeach
                            </select>
                            @error('permission')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          <div>
                             <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm">
                             <i class="material-icons" style="font-size:15px">&#xe39d;</i>Add Permission</a>
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
function revokePermission(id){
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
        'Permission is safe :)',
        'error'
      )
    }
  })
}
</script>
@endsection