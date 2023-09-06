<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller {
   public function index() {  
     $roles = Role::paginate(10);
    return view('roles.index',['roles' => $roles]);
    // return view('permissions.index');
  }

  public function create() {
    return view('roles.create');
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(),[

      'name' => ['required', 'string', 'max:255'],

    ]);
    if ( $validator->passes() ) {
      $role = new Role();
      $role->name = $request->name;
      $role->save();
      Alert::success('Congrats', 'Role Successfully Added');
      return redirect()->back();
    } else {
      Alert::error('Error', 'Some Error Occurred');
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }

  public function edit($id) {
    $permissions = Permission::all();
    $role = Role::find($id);
    return view('roles.edit',compact('role','permissions')); 
  }

  public function update($id, Request $request) {
    $role = Role::find($id);
    $validator = Validator::make($request->all(),[

      'name' => ['required', 'string', 'max:255'],

    ]);
    if( $validator->passes() ) {
      $role = Role::find($id);
      $role->name = $request->name;
      $role->save();
      Alert::success('Success', 'Role Successfully Updated');
      return redirect()->route('roles.edit',$id);
    } else {
      Alert::error('Error', 'Some Error Occurred');
      return redirect()->route('roles.edit',$id)->withErrors($validator)->withInput();
    }
  }

  // public function destroy($id, Request $request) {
  //   $role = Role::find($id);
  //   $role->delete(); 
  //   Alert::success('Success', 'Role Deleted Successfully');
  //   return redirect()->back();
  // }

    public function deleterole(Request $request){
      $ids = $request->ids;
      if ( $ids != null ) {
      $role = Role::whereIn('id', $ids)->get();
      Role::whereIn('id', $ids)->delete();
      Alert::success('Success', 'Role Deleted Successfully');
      return redirect()->back();
      }
       else {
        Alert::error('Error', 'Please Select At Least One Record');
        return redirect()->back();
      }
    }

    public function givePermission(Request $request, Role $role) {
      if( $role->hasPermissionTo($request->permission)){
        Alert::error('Error', 'Permission Exsit');
        return redirect()->back();   
      } 
      $role->givePermissionTo($request->permission);
       Alert::success('Success', 'Permission Assign This Role Successfully');
      return redirect()->back();
    }

    public function revokePermission(Role $role, Permission $permission ) {
      if( $role->hasPermissionTo($permission)){
        $role->revokePermissionTo($permission);
        Alert::success('Success', 'Permission Revoked This Role Successfully');
        return redirect()->back();   
      } 
       Alert::error('Error', 'Permission Not Exsit');
      return redirect()->back();
    }
}
