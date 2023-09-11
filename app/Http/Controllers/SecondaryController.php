<?php
namespace App\Http\Controllers;
use App\Models\SecondaryLabel;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SecondaryController extends Controller {
  public function index() {
    $secondaries = SecondaryLabel::paginate(10);
    return view('secondaries.index',['secondaries' => $secondaries]);
  }

  public function create() {
    $products = Product::paginate(10);
    dd($products);
    return view('secondaries.create', compact('products'));
  }

  public function getSRelatedData(Request $request) {
    $productCode = $request->input('id');
    $relatedData = Product::where('product_code', $productCode)->get();
    return response()->json($relatedData);
  }

  public function store(Request $request) {
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
    if ($validator->passes()) {
      $secondaries = new SecondaryLabel();
      $secondaries->product_code = $request->product_id;
      $secondaries->manufacturer_name = $request->manufacturer_name;
      $secondaries->supplier_name = $request->supplier_name;
      $secondaries->category_name = $request->category_name;
      $secondaries->sub_category_name = $request->sub_category_name;
      $secondaries->product_name = $request->secondary_name;
      $secondaries->brand_name = $request->brand_name;
      $secondaries->uom_id = $request->uom_id;
      $secondaries->weight = $request->weight;
      
      $secondaries->batch_number = $request->batch_no;
      $secondaries->serial_number = $request->sub_category;
      $secondaries->manufacture_date = $request->mfg_date;
      $secondaries->expiry_date = $request->exp_date;
      $secondaries->quantity = $request->quantity;
      $secondaries->mrp = $request->mrp;
      $secondaries->qr_code = $qrcode;
      $secondaries->save();
      Alert::success('Congrats', 'Secondary Successfully Added');
      return redirect()->back();
    } else {
      Alert::error('Error', 'Some Error Occurred');
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }

  public function view($id) {
    $secondary = SecondaryLabel::find($id);
    return view('secondaries.view',['secondary'=>$secondary]); 
  }

  public function edit($id) {
    $secondary = SecondaryLabel::find($id);
    return view('secondaries.edit',['secondary'=>$secondary]); 
  }

  public function update($id, Request $request) {
    $secondaries = SecondaryLabel::find($id);
    $validator = Validator::make($request->all(),[
      'secondary' => ['string', 'max:255'],
      'applicationid' => ['string', 'max:255'],
      'secondary_code' => ['string', 'max:255'],
      'company_name' => ['string', 'max:255'],
      'manufacturer_name' => ['string', 'max:255'],
      'secondary_name' => ['string', 'max:255'],
      'supplier_name' => ['string', 'max:255'],
      'category' => ['string', 'max:255'],
      'sub_category' => ['string', 'max:255'],
      'brand_name' => ['string', 'max:255'],
      'weight' => ['string', 'max:255'],
      'uomid' => ['string', 'max:255'],
    ]);
    if ($validator->passes()) {
      $secondaries = SecondaryLabel::find($id);
      $secondaries->secondary = $request->secondary;
      $secondaries->applicationid = $request->applicationid;
      $secondaries->secondary_code = $request->secondary_code;
      $secondaries->company_name = $request->company_name;
      $secondaries->manufacturer_name = $request->manufacturer_name;
      $secondaries->secondary_name = $request->secondary_name;
      $secondaries->supplier_name = $request->supplier_name;
      $secondaries->category = $request->category;
      $secondaries->sub_category = $request->sub_category;
      $secondaries->brand_name = $request->brand_name;
      $secondaries->weight = $request->weight;
      $secondaries->uomid = $request->uomid;
      $secondaries->save();
      Alert::success('Success', 'Secondary Successfully Updated');
      return redirect()->route('secondaries.edit',$id);
    } else {
      Alert::error('Error', 'Some Error Occurred');
      return redirect()->route('secondaries.edit',$id)->withErrors($validator)->withInput();
    }
  }

  public function destroy($id, Request $request) {
    $secondary = SecondaryLabel::find($id);
    $secondary->delete(); 
    Alert::success('Success', 'Secondary Deleted Successfully');
    return redirect()->back();
  }

  public function deletesecondary(Request $request){
    $ids = $request->ids;
    $secondary = SecondaryLabel::whereIn('id', $ids)->get();
    SecondaryLabel::whereIn('id', $ids)->delete();
    Alert::success('Success', 'Secondary Deleted Successfully');
    return redirect()->back();
  }  
}