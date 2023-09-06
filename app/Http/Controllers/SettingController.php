<?php
namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SettingController extends Controller {
  public function index() {
    $settings = Setting::paginate(10);
    return view('/settingHome',['settings' => $settings]);
  }

  public function create() {
    return view('settings.create');
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(),[
      'logo' => ['image|mimes:jpeg,png,jpg,gif,svg'],
      'favicon' => ['image|mimes:jpeg,png,jpg,gif,svg'],
      'footer_copyright' => ['string', 'max:255'],
      'contact_address' => ['string', 'max:255'],
      'contact_email' => ['string', 'max:255'],
      'contact_phone' => ['string', 'max:255'],
      'contact_fax' => ['string', 'max:255'],
      'contact_map_iframe' => ['string', 'max:255'],
      'receive_email' => ['string', 'max:255'],
      'receive_email_subject' => ['string', 'max:255'],
      'receive_email_thank_you_message' => ['string', 'max:255'],
      'footer_copyright' => ['string', 'max:255'],
      'meta_title_home' => ['string', 'max:255'],
    ]);
    if ($validator->passes()) {
      $settings = new Setting();
      if ($request->hasFile('logo')) {
        $settings->logo = $request->logo;
        $image_new_name = time() . $settings->logo->getClientOriginalName();
        $settings->logo->move('images',$image_new_name);
        $settings->logo= 'images/' . $image_new_name;
      }
      if ($request->hasFile('favicon')) {
        $settings->favicon = $request->favicon;
        $image_new_name = time() . $settings->favicon->getClientOriginalName();
        $settings->favicon->move('images',$image_new_name);
        $settings->favicon= 'images/' . $image_new_name;
      }
      $settings->contact_address = $request->contact_address;
      $settings->contact_email = $request->contact_email;
      $settings->contact_phone = $request->contact_phone;
      $settings->contact_fax = $request->contact_fax;
      $settings->contact_map_iframe = $request->contact_map_iframe;
      $settings->receive_email = $request->receive_email;
      $settings->receive_email_subject = $request->receive_email_subject;
      $settings->receive_email_thank_you_message = $request->receive_email_thank_you_message;
      $settings->footer_copyright = $request->footer_copyright;
      $settings->meta_title_home = $request->meta_title_home;
      $settings->save();
      Alert::success('Congrats', 'Setting Successfully Added');
      return redirect()->back();
    } else {
      Alert::error('Error', 'Some Error Occurred');
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }

  public function edit($id) {
    $setting = Setting::find($id);
    return view('settings.edit',['setting'=>$setting]); 
  }

  public function update($id, Request $request) {
    $settings = Setting::find($id);
    $validator = Validator::make($request->all(),[
      'logo' => ['image|mimes:jpeg,png,jpg,gif,svg'],
      'favicon' => ['image|mimes:jpeg,png,jpg,gif,svg'],
      'footer_copyright' => ['string', 'max:255'],
      'contact_address' => ['string', 'max:255'],
      'contact_email' => ['string', 'max:255'],
      'contact_phone' => ['string', 'max:255'],
      'contact_fax' => ['string', 'max:255'],
      'contact_map_iframe' => ['string', 'max:255'],
      'receive_email' => ['string', 'max:255'],
      'receive_email_subject' => ['string', 'max:255'],
      'receive_email_thank_you_message' => ['string', 'max:255'],
      'meta_title_home' => ['string', 'max:255'],
    ]);
    if ($validator->passes() ) {
      $settings = Setting::find($id);
      if ($request->hasFile('logo') ) {
        $settings->logo = $request->logo;
        $image_new_name = time() . $settings->logo->getClientOriginalName();
        $settings->logo->move('images',$image_new_name);
        $settings->logo= 'images/' . $image_new_name;
      }
      if ($request->hasFile('favicon')) {
        $settings->favicon = $request->favicon;
        $image_new_name = time() . $settings->favicon->getClientOriginalName();
        $settings->favicon->move('images',$image_new_name);
        $settings->favicon= 'images/' . $image_new_name;
      }
      $settings->footer_copyright = $request->footer_copyright;
      $settings->contact_address = $request->contact_address;
      $settings->contact_email = $request->contact_email;
      $settings->contact_phone = $request->contact_phone;
      $settings->contact_fax = $request->contact_fax;
      $settings->contact_map_iframe = $request->contact_map_iframe;
      $settings->receive_email = $request->receive_email;
      $settings->receive_email_subject = $request->receive_email_subject;
      $settings->receive_email_thank_you_message = $request->receive_email_thank_you_message;
      $settings->meta_title_home = $request->meta_title_home;
      $settings->save();
      Alert::success('Success', 'Setting Successfully Updated');
      return redirect()->route('settings.edit',$id);
    } else {
      Alert::error('Error', 'Some Error Occurred');
      return redirect()->route('settings.edit',$id)->withErrors($validator)->withInput();
    }
  }

  public function destroy($id, Request $request) {
    $setting = Setting::find($id);
    $setting->delete(); 
    Alert::success('Success', 'Setting Deleted Successfully');
    return redirect()->back();
  }

  public function deletesetting(Request $request){
    $ids = $request->ids;
    $setting = Setting::whereIn('id', $ids)->get();
    Setting::whereIn('id', $ids)->delete();
    Alert::success('Success', 'Setting Deleted Successfully');
    return redirect()->back();
  }
}
