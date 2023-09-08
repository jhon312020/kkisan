<?php
namespace App\Http\Controllers;
use App\Models\PrimaryLabel;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Product;
use App\Models\LabelType;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\View;
use PDF;

class PrimaryController extends Controller {

  public function index() {
    $primaries = PrimaryLabel::paginate(10);
    return view('primaries.index',['primaries' => $primaries]);
  }

  public function create() {
    $products = Product::where('status', 1)->get();
    $types = LabelType::where('status', 1)->get();
    return view('primaries.create',compact('products','types'));
  }

  public function getRelatedData(Request $request) {
    $productCode = $request->input('id');
    $relatedData = Product::where('product_code', $productCode)->get();
    return response()->json($relatedData);
  }

  public function generateNumber() {
    $lastNumber = PrimaryLabel::max('qr_code');
    if ($lastNumber && is_numeric($lastNumber) && $lastNumber >= 2300000001 && $lastNumber <= 2300999999) {
      $nextNumber = $lastNumber + 1;
    } else {
      $nextNumber = 2300000001;
    }
    return $nextNumber;
  }

  public function store(Request $request) {
    $product = Product::where('product_code',$request->product_id)->first();
    $productName = $product->product_name;
    $searchCategoryName = $request->category;
    $qrcodes = [];
    if ($request->quantity) {
      $quantity = $request->quantity;
      
      for ($i = 0; $i < $quantity; $i++) {
          $qrcodes[] = [+$i => $this->generateNumber() + $i];
      }
      
    }
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
      $primaries = new PrimaryLabel();
      $primaries->product_code = $request->product_id;
      $primaries->manufacturer_name = $request->manufacturer_name;
      $primaries->supplier_name = $request->supplier_name;
      $primaries->category_name = $request->category_name;
      $primaries->sub_category_name = $request->sub_category_name;
      $primaries->product_name = $productName;
      $primaries->brand_name = $request->brand_name;
      $primaries->uom_id = $request->uom_id;
      $primaries->weight = $request->weight;
      $primaries->batch_number = $request->batch_no;
      $primaries->serial_number = $request->sub_category;
      $primaries->manufacture_date = $request->mfg_date;
      $primaries->expiry_date = $request->exp_date;
      $primaries->quantity = $request->quantity;
      $primaries->mrp = $request->mrp;
      $primaries->label_type = $request->type;
      $primaries->qr_code = json_encode($qrcodes);
      $primaries->save();
      Alert::success('Congrats', 'Primary Successfully Added');
      return redirect()->back();
    } else {
      Alert::error('Error', 'Some Error Occurred');
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }

  public function edit($id) {
    $primary = PrimaryLabel::find($id);
    return view('primaries.edit',['primary'=>$primary]); 
  }

  public function update($id, Request $request) {
    $primaries = PrimaryLabel::find($id);
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
    if ($validator->passes() ) {
      $primaries = PrimaryLabel::find($id);
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
    $primary = PrimaryLabel::find($id);
    $primary->delete(); 
    Alert::success('Success', 'Primary Deleted Successfully');
    return redirect()->back();
  }

  public function deleteprimary(Request $request){
    $ids = $request->ids;
    $primary = PrimaryLabel::whereIn('id', $ids)->get();
    PrimaryLabel::whereIn('id', $ids)->delete();
    Alert::success('Success', 'Primary Deleted Successfully');
    return redirect()->back();
  }

  public function view($id) { 
    $primary = PrimaryLabel::find($id); 
    return view('primaries.view',['primary'=>$primary]);  
  }  
  public function printLabel($id) { 
    $primary = PrimaryLabel::find($id); 
    return view('primaries.printLabel',['primary'=>$primary]);  
  }

public function primaryprint($id) { 
    $primary = PrimaryLabel::find($id);
    
    if ($primary->LabelType->name == 'small') {
        $qrcodes = json_decode($primary->qr_code);
        $qrCodesArray = [];
        $counter = 0; // Initialize a counter variable

        foreach ($qrcodes as $subArray) {
            foreach ($subArray as $value) {
                $qrCodeValue = "01" . str_pad($value, 10, '0', STR_PAD_LEFT);
                $qrCode = QrCode::generate($qrCodeValue);
                $qrCodesArray[] = [
                    'qrCode' => $qrCode,
                    'value' => $qrCodeValue,
                ];

                $fileName = "qrcode_$counter.png"; // Use the counter as the filename
                $filePath = public_path("qrcodes/$fileName");
                file_put_contents($filePath, $qrCode);

                $counter++; // Increment the counter
            }
        }

        // Load the PDF view and pass the QR codes array
        $pdf = PDF::loadView('primaries.pdf', [
            'qrCodesArray' => $qrCodesArray,
            'primary' => $primary,
        ]);

        return $pdf->download('primaries.pdf');
    }
}
}
