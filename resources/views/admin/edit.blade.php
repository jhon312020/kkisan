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
          <!-- <div style="position:relative; left:450px; top:10px;">
            <a href="{{ url('/adminHome') }}" class="btn btn-primary btn-sm">User List</a>
          </div> -->
          <br>
          <div class="container">
            <div class="row justify-content-center">
              <div class="row profile-card">
              <div class="col-lg-5 col-md-12 col-sm-12">
                <div class="card">
                  <!-- @if(auth()->user()->hasRole('sadmin'))
                    <div class="card-header">{{ __('Employee Update') }}  <a href="{{ url('/adminHome') }}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe851;</i>Employee List</a></div>
                  @else
                    <div class="card-header" style="background-color:blue;color: whitesmoke;">{{ __('Profile') }}</div>
                  @endif -->

                  <div class="card-body">
                    <div class="card-body">
                      <center>
                      <img src="{{asset($user->profile_pic)}}" style="width:100px; height: 100px;">
                      <h4>{{ auth()->user()->name }} </h4>
                      <h4>{{ auth()->user()->company_name }} </h4>
                      <!-- <br> -->
                      <h4>{{ auth()->user()->email }}</h4>
                      </center>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="card">
                  <div class="card-header" style="background-color:blue;color: whitesmoke;">{{ __('Admin Details') }}</div>
                  <div class="card-body">
                    <h4>Id:{{ auth()->user()->id }} </h4>
                    <h4>Name:{{ auth()->user()->name }} </h4>
                    <h4>Email: {{ auth()->user()->email }}</h4>
                    <h4>Mobile Number:{{auth()->user()->phone}} </h4>
                    <h4>Address:{{auth()->user()->address}} </h4>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
          <br>
          <div class="container">
            <div class="row justify-content-center">
              <div class="row profile-card">
              <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="card">
                  @if(auth()->user()->hasRole('sadmin'))
                    <div class="card-header">{{ __('Employee Update') }}  <a href="{{ url('/adminHome') }}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe851;</i>Employee List</a></div>
                  @else
                    <div class="card-header" style="background-color:blue;color: whitesmoke;">{{ __('Edit Profile') }}</div>
                  @endif

                  <div class="card-body">
                    <form method="POST" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data">
                      @csrf
                       @method('put')

                        <div class="row mb-3">
                          <label for="company_name" class="col-md-4 col-form-label text-md-end">{{ __('Company Name') }}</label>
                            <div class="col-md-6">
                              <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name',$user->company_name) }}"  autocomplete="company_name" autofocus>
                                @error('company_name')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label for="company_address" class="col-md-4 col-form-label text-md-end">{{ __('Company Address
                          ') }}</label>
                            <div class="col-md-6">
                              <input id="company_address" type="text" class="form-control @error('company_address') is-invalid @enderror" name="company_address" value="{{ old('company_address',$user->company_address) }}"  autocomplete="company_address" autofocus>
                                @error('company_address')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label for="company_district" class="col-md-4 col-form-label text-md-end">{{ __('Company District') }}</label>
                            <div class="col-md-6">
                              <input id="company_district" type="text" class="form-control @error('company_district') is-invalid @enderror" name="company_district" value="{{ old('company_district',$user->company_district) }}"  autocomplete="company_district" autofocus>
                                @error('company_district')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label for="company_state" class="col-md-4 col-form-label text-md-end">{{ __('Company State') }}</label>
                            <div class="col-md-6">
                              <input id="company_state" type="text" class="form-control @error('company_state') is-invalid @enderror" name="company_state" value="{{ old('company_state',$user->company_state) }}"  autocomplete="company_state" autofocus>
                                @error('company_state')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label for="company_pincode" class="col-md-4 col-form-label text-md-end">{{ __('Company Pincode') }}</label>
                            <div class="col-md-6">
                              <input id="company_pincode" type="text" class="form-control @error('company_pincode') is-invalid @enderror" name="company_pincode" value="{{ old('company_pincode',$user->company_pincode) }}"  autocomplete="company_pincode" autofocus>
                                @error('company_pincode')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$user->name) }}"  autocomplete="name" autofocus>
                                @error('name')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email) }}"  autocomplete="email">
                                @error('email')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>
                            <div class="col-md-6">
                              <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone',$user->phone) }}" autocomplete="phone">
                                @error('phone')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                            <div class="col-md-6">
                              <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address',$user->address) }}" autocomplete="address">
                                @error('address')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label for="profile_pic" class="col-md-4 col-form-label text-md-end">{{ __('Profile Pic') }}</label>
                            <div class="col-md-6">
                              <!-- <img src="{{asset($user->profile_pic)}}" style="width:100px; height: 100px;"> -->
                              <input id="profile_pic" type="file" class="form-control @error('profile_pic') is-invalid @enderror" name="profile_pic" value="{{ old('profile_pic', $user->profile_pic) }}">
                                @error('profile_pic')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                          <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" style="background-color:blue;color: whitesmoke;">
                              <i class="material-icons" style="font-size:15px">&#xe161;</i>
                              {{ __('Update') }}
                            </button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-12 col-sm-12">
                <div class="card">
                  <div class="card-header" style="background-color:blue;color: whitesmoke;">{{ __('Change Password') }}</div>
                  <div class="card-body">
                    <form method="POST" action="{{ route('users.passwordupdate',$user->id) }}" enctype="multipart/form-data">
                      @csrf
                       @method('POST')

                         <div class="row mb-3">
                          <label for="old_password" class="col-md-4 col-form-label text-md-end">{{ __('Old Password') }}</label>
                            <div class="col-md-6">
                              <input id="old_password" type="old_password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" autocomplete="old_password">
                                @error('old_password')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                @error('password')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div> 

                        <div class="row mb-0">
                          <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" style="background-color:blue;color: whitesmoke;">
                              <i class="material-icons" style="font-size:15px">&#xe161;</i>
                              {{ __('Update') }}
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
          @if(auth()->user()->hasRole('sadmin'))
          @if($user->roles->isNotEmpty())
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-10">
                <div class="card">
                  <div class="card-header">{{ __('Employee Has Roles') }}</div>
                    <div class="card-body">
                    @if( $user->roles )
                      @foreach( $user->roles as $user_role )
                      <form id="target" action="{{ route('users.roles.remove', [$user->id, $user_role->id]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <br>
                      <button  class="btn btn-danger revokeRole" onclick="revokeRole(id);" type="button">{{ $user_role->name }}</button>
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
                  <div class="card-header">{{ __('Employee Role Add') }}  <a href="{{ route('roles.index') }}" style="position: absolute;right: 10px;"class="btn btn-primary btn-sm"><i class="fa-solid fa-unlock-keyhole"></i>Role</a></div>

                  <div class="card-body">
                    <form method="POST" action="{{ route('users.roles',$user->id) }}" enctype="multipart/form-data">
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
          </div>

          @if($user->permissions->isNotEmpty())
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-10">
                <div class="card">
                  <div class="card-header">{{ __('Employee Has Permission') }}</div>
                    <div class="card-body">
                    @if( $user->permissions )
                      @foreach( $user->permissions as $user_permission )
                      <form id="target" action="{{ route('users.permissions.revoke', [$user->id, $user_permission->id]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <br>
                      <button  class="btn btn-danger removeRole" onclick="removePermission(id);" type="button">{{ $user_permission->name }}</button>
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
                  <div class="card-header">{{ __('Employee Permission Add') }}  <a href="{{ route('permissions.index') }}" style="position: absolute;right: 10px;"class="btn btn-primary btn-sm"><i class="fa-solid fa-unlock-keyhole"></i>Permsission</a></div>

                  <div class="card-body">
                    <form method="POST" action="{{ route('users.permissions',$user->id) }}" enctype="multipart/form-data">
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
          </div>
        </div>
      </div>
  @else
@endif

<script>
function removePermission(id){
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

function revokeRole(id){
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