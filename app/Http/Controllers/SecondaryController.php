<?php
namespace App\Http\Controllers;
use App\Models\SecondaryLabel;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Product;
use App\Models\PrimaryLabel;
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
    // dd($secondaries);
    return view('secondaries.index',['secondaries' => $secondaries]);
  }

  public function create() {
    $products = Product::where('is_secondary',1)->get();
    $productIds = $products->pluck('id')->toArray();
    $primaries = PrimaryLabel::whereIn('ProductCode',$productIds)->get();
    return view('secondaries.create', compact('products','primaries'));
  }

  public function getSRelatedData(Request $request) {
    $productCode = $request->input('id');
    $relatedDataSecondary = PrimaryLabel::where('id', $productCode)->first();
    $relatedData = $relatedDataSecondary->quantity;
    return response()->json($relatedData);
  }

  public function store(Request $request) {
    $lastGeneratedCode = SecondaryLabel::max('id')??0;
    $newSecondaryCode = $lastGeneratedCode + 1;
    $SecondaryCode = '00002300' . str_pad($newSecondaryCode, 12, '0', STR_PAD_LEFT);
    $lastGeneratedQRCode = SecondaryLabel::max('Secondary_QRCode')??0;
    $newSecondaryQRCode = $lastGeneratedQRCode + 1;
    $SecondaryQRCode = '002300' . str_pad($newSecondaryQRCode, 4, '0', STR_PAD_LEFT);
    $primary = PrimaryLabel::where('id', $request->labelid)->first();
    $product = Product::find($primary->Product->id)->first();
    //$primary = PrimaryLabel::where('ProductCode', $product->id)->first();
    $Totalquantity = $request->quantity;
    $requriedquantity = $request->label_numbers;
    $divisionResult = intval($Totalquantity / $requriedquantity);
    //dd($divisionResult);
    $validator = Validator::make($request->all(),[
      'labelid' => ['required'],
      'quantity' => ['required', 'integer'],
      'label_numbers' => ['required', 'integer', 'max:20', 'min:5'],
    ]);
    if ($validator->passes()) {
      $secondaries = new SecondaryLabel();
      $secondaries->SecondaryContainerCode = $SecondaryCode;
      $secondaries->Secondary_quantity = $request->label_numbers;
      $secondaries->Secondary_QRCode = $SecondaryQRCode;
      $secondaries->ProductCode = $product->id;
      $secondaries->primary_label = $primary->id;
      $secondaries->SerialNumber = $primary->SerialNumber;
      $secondaries->QRCode = $primary->QRCode;
      $secondaries->label_type = $primary->label_type;
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