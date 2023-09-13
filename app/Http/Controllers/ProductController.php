<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\UnitOfMeasurement;
use App\Models\Application;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Excel;
use App\Exports\YourExcelExport;

class ProductController extends Controller {
  public function index() {
    $products = Product::paginate(10);
    return view('products.index',['products' => $products]);
  }

  public function create() {
    // $this->postDatatoAPI();
    $guoms = UnitOfMeasurement::where('local_status',1)->get();
    $applications = Application::where('local_status',1)->get();
    $categories = Category::where('local_status',1)->get();
    $subcategories = SubCategory::where('local_status',1)->get();
    $items = Item::where('local_status',1)->get();
    return view('products.create',compact('guoms','applications','categories','subcategories','items'));
  }

  public function store(Request $request) {
    // $this->pr($request->all());
    $lastGeneratedCode = Product::max('id')??0;
    $newProductCode = $lastGeneratedCode + 1;
    $portalID = '23';
    $vendorID = '99';
    $productCode = '0000'.$portalID.$vendorID . str_pad($newProductCode, 6, '0', STR_PAD_LEFT);
    // exit;
    $validator = Validator::make($request->all(),[
      'is_secondary' => ['required'],
      'ApplicationID' => ['required'],
      'company_name' => ['required'],
      'ManufacturerName' => ['required'],
      'ProductName' => ['required'],
      'SupplierName' => ['required'],
      'ItemCategoryID' => ['required'],
      'SubCategoryID' => ['required'],
      'BrandName' => ['required'],
      'Weight' => ['required'],
      'UomID' => ['required'],
    ]);
    if ($validator->passes() ) {
      $product = new Product();
      $product->is_secondary = $request->is_secondary;
      $product->ApplicationID = $request->ApplicationID;
      $product->ProductCode = $productCode;
      $product->company_name = $request->company_name;
      $product->MarketedBy = $request->MarketedBy;
      $product->ManufacturerName = $request->ManufacturerName;
      $product->ProductName = $request->ProductName;
      $product->SupplierName = $request->SupplierName;
      $product->ItemCategoryID = $request->ItemCategoryID;
      $product->SubCategoryID = $request->SubCategoryID;
      $product->BrandName = $request->BrandName;
      $product->Weight = $request->Weight;
      $product->UomID = $request->UomID;
      $product->ItemID = $request->ItemID;
      if ($product->save()) {
        $categories = Category::where('ApplicationID', $product->ApplicationID)
          ->where('local_status',1)
          ->where('ItemCategoryID', $product->ItemCategoryID)
          ->pluck('ItemCategoryName', 'ItemCategoryID');
          // $this->pr($categories);
        $subCategories = SubCategory::where('ApplicationID', $product->ApplicationID)
        ->where('local_status',1)
        ->where('SubCategoryID', $product->SubCategoryID)
        ->pluck('SubCategoryName', 'SubCategoryID');
        // $this->pr($subCategories);
        $productData = array(
          "ApplicationID"=> $product->ApplicationID,
          "ProductCode"=> $product->ProductCode,
          "MarketedBy"=> $product->MarketedBy,
          "LicenseNumber"=> "test",
          "CIBRegistrationCertificate"=> "test",
          "ManufacturerName"=> $product->ManufacturerName,
          "SupplierName"=> $product->SupplierName,
          "ItemCategoryID"=> $product->ItemCategoryID,
          "CategoryName"=> $categories[$product->ItemCategoryID],
          "SubCategoryID"=> $product->SubCategoryID,
          "SubCategoryName"=> $subCategories[$product->SubCategoryID] ,
          "ItemID"=> $product->ItemID?$product->ItemID:0,
          "ProductName"=> $product->ProductName,
          "BrandName"=> $product->BrandName,
          "UomID"=> $product->UomID,
          "Weight"=> $product->Weight
        );
        $apiResult = $this->postDatatoAPI("SaveProductMaster", $productData, $this->accessToken);
        if ($apiResult && isset($apiResult['success'])) {
          $product->api_sync_status = true;
          $product->save();
        }
      }
      // exit;
      Alert::success('Congrats', 'Product Successfully Added');
      return redirect()->back();
    } else {
      // $this->pr($validator->errors());
      // exit;
      Alert::error('Error', 'Some Error Occurred');
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }

  public function show() { 
  }

  public function edit($id) {
    $product = Product::find($id);
    return view('products.edit',['product'=>$product]); 
  }

  public function update($id, Request $request) {
    $products = Product::find($id);
    $validator = Validator::make($request->all(),[
      'secondary' => ['string', 'max:255'],
      'applicationid' => ['string', 'max:255'],
      'product_code' => ['string', 'max:255'],
      'company_name' => ['string', 'max:255'],
      'manufacturer_name' => ['string', 'max:255'],
      'product_name' => ['string', 'max:255'],
      'supplier_name' => ['string', 'max:255'],
      'category' => ['string', 'max:255'],
      'sub_category' => ['string', 'max:255'],
      'brand_name' => ['string', 'max:255'],
      'weight' => ['string', 'max:255'],
      'uomid' => ['string', 'max:255'],
    ]);
    if ($validator->passes()) {
      $products = Product::find($id);
      $product->is_secondary = $request->secondary;
      $product->ApplicationID = $request->applicationid;
      $product->ProductCode = $request->product_code;
      $product->company_name = $request->company_name;
      $product->ManufacturerName = $request->manufacturer_name;
      $product->ProductName = $request->product_name;
      $product->SupplierName = $request->supplier_name;
      $product->ItemCategoryID = $request->category;
      $product->SubCategoryID = $request->sub_category;
      $product->BrandName = $request->brand_name;
      $product->Weight = $request->weight;
      $product->UomID = $request->uomid;
      $product->save();
      Alert::success('Success', 'Product Successfully Updated');
      return redirect()->route('products.edit',$id);
    } else {
      Alert::error('Error', 'Some Error Occurred');
      return redirect()->route('products.edit',$id)->withErrors($validator)->withInput();
    }
  }

  public function destroy($id, Request $request) {
    $product = Product::find($id);
    $product->delete(); 
    Alert::success('Success', 'Product Deleted Successfully');
    return redirect()->back();
  }

  public function deleteproduct(Request $request){
    $ids = $request->ids;
    $product = Product::whereIn('id', $ids)->get();
    Product::whereIn('id', $ids)->delete();
    Alert::success('Success', 'Product Deleted Successfully');
    return redirect()->back();
  }

  public function view($id) { 
    $product = Product::find($id); 
    return view('products.view',['product'=>$product]);  
  }

  public function getProductCategory(Request $request) {
    $applicationID = $request->input('applicationID');
    $categories = Category::select('ItemCategoryID', 'ItemCategoryName')->where('ApplicationID', $applicationID)->get();
    return view('products.getProductCategory',['categories'=>$categories]);
  }

  public function getProductSubcategory(Request $request) {
    $applicationID = $request->input('applicationID');
    $subcategories = SubCategory::where('ApplicationID', $applicationID)->get();
    return view('products.getProductSubcategory',['subcategories'=>$subcategories]);
  }

  public function getProductItems(Request $request) {
    $applicationID = $request->input('applicationID');
    $items = Item::where('ApplicationID', $applicationID)->where('local_status', 1)->get();
    return view('products.getProductItems', ['items'=>$items]);
  }

   public function excelView(Request $request) {
    $products = Product::paginate(10);
    return view('products.excelView',['products'=>$products]);
  }

  public function downloadExcel() {
    return Excel::download(new YourExcelExport, 'Product.xlsx');
  }
}