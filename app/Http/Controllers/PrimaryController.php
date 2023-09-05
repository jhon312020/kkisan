<?php

namespace App\Http\Controllers;

use App\Models\Primary_Label;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Vote;
use App\Models\Product;
use App\Models\Candidate;
use App\Models\Position;
use App\Models\About;
use App\Models\Contact;
use App\Models\Enquiry;
use App\Models\Country;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Charts\CandidateVotesChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PrimaryController extends Controller {
  // public function index(Request $request) {
  //   $search = $request['search'] ?? "";
  //   if ($search != "") {
  //       $primaries = primary::where('name', 'LIKE', "%$search%")
  //                   ->orWhere('code', 'LIKE', "%$search%")->paginate(10);
  //   } else {
  //       $primaries = primary::paginate(10);
  //   }
  //   $data = compact('primaries','search');
  //   return view('/primaryHome')->with($data);
  // }

  public function index() {
    $primaries = Primary_Label::paginate(10);
    return view('/primaryHome',['primaries' => $primaries]);
  }

  function fetchAPIData($requestURL) { 
    $apiURL = "https://kkisan.karnataka.gov.in/KKISANQRAPI/api/";
    $dataURL = $apiURL.$requestURL;
    $ch = curl_init($dataURL);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $contents = curl_exec($ch);
    $data = json_decode($contents);
    return $data; curl_close($ch);
  }

  public function create() {
    $guoms = $this->fetchAPIData('GetUnitOfMeasurements');
    $applications = $this->fetchAPIData('Master/GetKKISANApplications');
    $categorries = $this->fetchAPIData('Master/GetItemCategory?ApplicationID=FL');
    $subcategorries = $this->fetchAPIData('Master/GetItemSubCategory?ApplicationID=FL');
    $item = $this->fetchAPIData('Master/GetItemDetail?ApplicationID=FL');
    $products = Product::paginate(10);
    return view('primaries.create',compact('guoms','applications','categorries','subcategorries','item','products'));
  }

  public function getRelatedData(Request $request) {
    $productCode = $request->input('id');
    $relatedData = Product::where('product_code', $productCode)->get();
    return response()->json($relatedData);
  }

  public function store(Request $request) {
    $guoms = $this->fetchAPIData('GetUnitOfMeasurements');
    $applications = $this->fetchAPIData('Master/GetKKISANApplications');
    $categorries = $this->fetchAPIData('Master/GetItemCategory?ApplicationID=FL');
    $subcategorries = $this->fetchAPIData('Master/GetItemSubCategory?ApplicationID=FL');
    $item = $this->fetchAPIData('Master/GetItemDetail?ApplicationID=FL');
    $searchCategoryName = $request->category;
      $itemCategoryId = null;
      foreach ($categorries as $item) {
          if ($item->ItemCategoryName == $searchCategoryName) {
              $itemCategoryId = $item->ItemCategoryID;
              break;
          }
      }
      $searchSubCategoryName = $request->sub_category;
      $subCategoryId = null;
      foreach ($subcategorries as $item) {
          if ($item->SubCategoryName == $searchSubCategoryName) {
              $subCategoryId = $item->SubCategoryID;
              break;
          }
      }
      $qrcode = rand(1000000000, 9999999999);

      // if ($itemCategoryId !== null) {
      //     echo "ItemCategoryID: " . $itemCategoryId;
      // } else {
      //     echo "SubCategory not found.";
      // }
      // dd($request->all());
    $validator = Validator::make($request->all(),[

      'product_id' => ['required'],
      'manufacturer_name' => ['required'],
      'supplier_name' => ['required'],
      'category_name' => ['required'],
      'sub_category_name' => ['required'],
      'brand_name' => ['required'],
      'weight' => ['required'],
      'uom_id' => ['required'],
      'batch_no' => ['required'],
      'mfg_date' => ['required'],
      'exp_date' => ['required'],
      'quantity' => ['required'],
      'mrp' => ['required'],

    ]);
    if ( $validator->passes() ) {
      $primaries = new Primary_Label();
      $primaries->product_code = $request->product_id;
      $primaries->manufacturer_name = $request->manufacturer_name;
      $primaries->supplier_name = $request->supplier_name;
      $primaries->category_name = $request->category_name;
      $primaries->sub_category_name = $request->sub_category_name;
      $primaries->product_name = $request->primary_name;
      $primaries->brand_name = $request->brand_name;
      $primaries->uom_id = $request->uom_id;
      $primaries->weight = $request->weight;
      
      $primaries->batch_number = $request->batch_no;
      $primaries->serial_number = $request->sub_category;
      $primaries->manufacture_date = $request->mfg_date;
      $primaries->expiry_date = $request->exp_date;
      $primaries->quantity = $request->quantity;
      $primaries->mrp = $request->mrp;
      $primaries->qr_code = $qrcode;
      $primaries->save();
      Alert::success('Congrats', 'Primary Successfully Added');
      return redirect()->back();
    } else {
      Alert::error('Error', 'Some Error Occurred');
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }

  public function edit($id) {
    $primary = Primary_Label::find($id);
    return view('primaries.edit',['primary'=>$primary]); 
  }

  public function update($id, Request $request) {
    $primaries = Primary_Label::find($id);
    $validator = Validator::make($request->all(),[

      'secondary' => ['string', 'max:255'],
      'applicationid' => ['string', 'max:255'],
      'primary_code' => ['string', 'max:255'],
      'company_name' => ['string', 'max:255'],
      'manufacturer_name' => ['string', 'max:255'],
      'primary_name' => ['string', 'max:255'],
      'supplier_name' => ['string', 'max:255'],
      'category' => ['string', 'max:255'],
      'sub_category' => ['string', 'max:255'],
      'brand_name' => ['string', 'max:255'],
      'weight' => ['string', 'max:255'],
      'uomid' => ['string', 'max:255'],

    ]);
    if( $validator->passes() ) {
      $primaries = Primary_Label::find($id);
      $primaries->secondary = $request->secondary;
      $primaries->applicationid = $request->applicationid;
      $primaries->primary_code = $request->primary_code;
      $primaries->company_name = $request->company_name;
      $primaries->manufacturer_name = $request->manufacturer_name;
      $primaries->primary_name = $request->primary_name;
      $primaries->supplier_name = $request->supplier_name;
      $primaries->category = $request->category;
      $primaries->sub_category = $request->sub_category;
      $primaries->brand_name = $request->brand_name;
      $primaries->weight = $request->weight;
      $primaries->uomid = $request->uomid;
      $primaries->save();
      Alert::success('Success', 'Primary Successfully Updated');
      return redirect()->route('primaries.edit',$id);
    } else {
      Alert::error('Error', 'Some Error Occurred');
      return redirect()->route('primaries.edit',$id)->withErrors($validator)->withInput();
    }
  }

  public function destroy($id, Request $request) {
    $primary = Primary_Label::find($id);
    $primary->delete(); 
    Alert::success('Success', 'Primary Deleted Successfully');
    return redirect()->back();
  }

  // public function deletetype(Request $request){
  //   $ids = $request->ids;
  //   Type::whereIn('id', $ids)->delete();
  //   Alert::success('Success', 'Bus Type Deleted Successfully');
  //   return redirect()->back();
  // }

  public function deleteprimary(Request $request){
    $ids = $request->ids;
    $primary = Primary_Label::whereIn('id', $ids)->get();
    Primary_Label::whereIn('id', $ids)->delete();
    Alert::success('Success', 'Primary Deleted Successfully');
    return redirect()->back();
  }
}