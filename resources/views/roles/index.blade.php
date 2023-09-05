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
      <div class="d-flex justify-content-between py-3">
        </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">{{ __('Role') }}  <a href="{{ route('roles.create')}}" style="position: absolute;right: 10px;" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe39d;</i>Add Role</a></div>
              <!-- <div class="card-header">{{ __('Roles') }}</div> -->

              <div class="card-body">
                <form id="target" action="/delete-roles" method="POST">
                @csrf
                  <table class="table table-striped">
                    <tr>
                      <th><input type="checkbox" id="selectAll"></th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                    @if ( $roles->isNotEmpty() )
                    @foreach ( $roles as $role )
                    <tr valign="middle">
                       <td>
                        <div class="form-check form-switch">
                           <input  type="checkbox" style="inline-size:fix-content;margin-left:%;margin-top: 8%;" class="form-check-input dynamicCheckbox" name="ids[{{$role->id }}]" value="{{$role->id }}" id="{{ $role->id }}">
                         </div>
                       </td>
                      <td>{{ $role->name}}</td>
                      <td>
                        <a href="{{ route('roles.edit',$role->id)}}" class="btn btn-primary btn-sm"><i class="material-icons" style="font-size:15px">&#xe254;</i>Edit</a>
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td colspan="6">Record Not Found</td>
                    </tr>
                    @endif
                  </table> 
                  <!-- <button type="submit" value="Delete types" onclick="return confirm('are you sure you want to delete this Bus Type')" class="btn btn-danger" for="Delete types">Delete Bus Type</button> -->
                @if ( $roles->isNotEmpty() )
                 <button type="button" value="Delete abouts" onclick="deleteroles(id);" class="btn btn-danger" for="Delete roles"><i class="material-icons" style="font-size:15px">&#xe872;</i>Delete Role</button>
                @else
                @endif
                  </form> 
                  <div class="mt-3">
                    {{ $roles->links() }}
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

function deleteroles(id){
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
        'about is safe :)',
        'error'
      )
    }
  })
}


  // function deletecategorys(id)
  // {
  //   event.preventDefault();
  //   if(confirm("Are you sure want to delete"))
  //   {
  //     document.getElementById('category-edit-action-'+id).submit();
  //   }
  // }
</script>
@endsection