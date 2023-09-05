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
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">{{ __('Employee List') }}   <a href="{{ route('users.create') }}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe7fe;</i>Add Employee</a>
          </div>
          <br>
          <div class="card-body">
          <form id="target" name="myForm" action="/delete-users" method="POST">
            @csrf
              <table class="table table-striped">
                <tr>
                  <th><input type="checkbox" id="selectAll"></th>
                  <th>NAME</th>
                  <th>EMAIL</th>
                  <th>ACTION</th>
                  <th></th>
                </tr>
                @if ( $users->isNotEmpty() )
                @foreach ( $users as $user )
                <tr valign="middle">
                  <td>
                    <div class="form-check form-switch">
                       <input  type="checkbox" style="inline-size:fix-content;margin-left:-30%;margin-top: 8%;" class="dynamicCheckbox" name="ids[{{$user->id }}]" value="{{$user->id }}" id="{{ $user->id }}">
                     </div>
                   </td>
                  <td>{{ $user->name}}</td>
                  <td>{{ $user->email}}</td>
                  <td>
                    <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary btn-sm">
                      <i class="material-icons" style="font-size:15px">&#xe254;</i>
                    Edit</a>
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="6">Record Not Found</td>
                </tr>
                @endif
              </table> 
              <!-- <button type="submit" value="Delete Users" onclick="return confirm('are you sure you want to delete this user')" class="btn btn-danger servideletebtn" for="Delete Users">Delete Users</button> -->

              @if ( $users->isNotEmpty() )
              <button type="button" value="Delete Users" onclick="deleteUsers(id);" class="btn btn-danger servideletebtn" for="Delete Users"><i class="material-icons" style="font-size:15px">&#xe872;</i>Delete Employees</button>
              @else 
              @endif
          </form> 
              <div class="mt-3">
                {{ $users->links() }}
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


function deleteUsers(id){
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
        'Employee is safe :)',
        'error'
      )
    }
  })
}

  // function deleteUser(id) {
  //   event.preventDefault();
  //   if(confirm("Are you sure want to delete"))
  //   {
  //     document.getElementById('user-edit-action-'+id).submit();
  //   }
  // }
</script>
@endsection