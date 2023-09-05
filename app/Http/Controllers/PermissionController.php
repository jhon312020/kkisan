<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Vote;
use App\Models\Voter;
use App\Models\Candidate;
use App\Models\Position;
use App\Models\About;
use App\Models\Contact;
use App\Models\Enquiry;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Charts\CandidateVotesChart;

class PermissionController extends Controller {
   public function index() {
    $permissions = Permission::paginate(10);
    return view('permissions.index',['permissions' => $permissions]);  
    // return view('permissions.index');
  }

  public function create() {
    return view('permissions.create');
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(),[

      'name' => ['required', 'string', 'max:255'],

    ]);
    if ( $validator->passes() ) {
      $permission = new Permission();
      $permission->name = $request->name;
      $permission->save();
      Alert::success('Congrats', 'Permission Successfully Added');
      return redirect()->back();
    } else {
      Alert::error('Error', 'Some Error Occurred');
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }

  public function edit($id) {
    $roles = Role::all();
    $permission = Permission::find($id);
    return view('permissions.edit',compact('roles','permission'));  
  }

  public function update($id, Request $request) {
    $permission = Permission::find($id);
    $validator = Validator::make($request->all(),[

      'name' => ['required', 'string', 'max:255'],

    ]);
    if( $validator->passes() ) {
      $permission = Permission::find($id);
      $permission->name = $request->name;
      $permission->save();
      Alert::success('Success', 'Permission Successfully Updated');
      return redirect()->route('permissions.edit',$id);
    } else {
      Alert::error('Error', 'Some Error Occurred');
      return redirect()->route('permissions.edit',$id)->withErrors($validator)->withInput();
    }
  }

  // public function destroy($id, Request $request) {
  //   $id = $request->ids;
  //   $permission = Permission::find($id);
  //   $permission->delete(); 
  //   Alert::success('Success', 'Permission Deleted Successfully');
  //   return redirect()->back();
  // }

    public function deletepermission(Request $request){
      $ids = $request->ids;
      if ( $ids != null ) {
      $permission = Permission::whereIn('id', $ids)->get();
      Permission::whereIn('id', $ids)->delete();
      Alert::success('Success', 'Permission Deleted Successfully');
      return redirect()->back();
      }
       else {
        Alert::error('Error', 'Please Select At Least One Record');
        return redirect()->back();
      }
    }

    public function assignRole(Request $request, Permission $permission) {
      if( $permission->hasRole($request->role)){
        Alert::error('Error', 'Role Exsit');
        return redirect()->back();   
      } 
      $permission->assignRole($request->role);
       Alert::success('Success', 'Role Assign This Permission Successfully');
      return redirect()->back();
    }

    public function removeRole(Permission $permission,Role $role ) {
      if( $permission->hasRole($role)){
        $permission->removeRole($role);
        Alert::success('Success', 'Role Revoked This Permission Successfully');
        return redirect()->back();   
      } 
       Alert::error('Error', 'Role Not Exsit');
      return redirect()->back();
    }
}
