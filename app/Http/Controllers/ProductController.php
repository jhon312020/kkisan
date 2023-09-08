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

class ProductController extends Controller {
  public function index() {
    $products = Product::paginate(10);
    return view('products.index',['products' => $products]);
  }

  public function create() {
    $guoms = UnitOfMeasurement::where('local_status',1)->get();
    $applications = Application::where('local_status',1)->get();
    $categories = Category::where('local_status',1)->get();
    $subcategories = SubCategory::where('local_status',1)->get();
    $items = Item::where('local_status',1)->get();
    return view('products.create',compact('guoms','applications','categories','subcategories','items'));
  }

  public function store(Request $request) {
    $guoms = UnitOfMeasurement::where('UomID',$request->uomid)->first();
    $applications = Application::where('id',$request->applicationid)->first();
    $categories = Category::where('id',$request->category)->first();
    $subcategories = SubCategory::where('SubCategoryName',$request->sub_category)->first();
    $items = Item::where('ApplicationID',$applications->ApplicationID)
                  ->orWhere('ItemCategoryID',$categories->ItemCategoryID)
                  ->orWhere('SubCategoryID',$subcategories->SubCategoryID)
                  ->orWhere('UomID',$guoms->UomID)
                  ->first();
    $lastGeneratedCode = Product::max('ProductCode') ?? 20999999999999;
    $newProductCode = $lastGeneratedCode + 1;
    $productCode = '2100' . str_pad($newProductCode, 10, '0', STR_PAD_LEFT);
    $lastGeneratedCode = $newProductCode;
    $validator = Validator::make($request->all(),[
      'secondary' => ['required'],
      'applicationid' => ['required'],
      'company_name' => ['required'],
      'manufacturer_name' => ['required'],
      'product_name' => ['required'],
      'supplier_name' => ['required'],
      'category' => ['required'],
      'sub_category' => ['required'],
      'brand_name' => ['required'],
      'weight' => ['required'],
      'uomid' => ['required'],
    ]);
    if ( $validator->passes() ) {
      $products = new Product();
      $products->is_secondary = $request->secondary;
      $products->ApplicationID = $applications->id;
      $products->ProductCode = $lastGeneratedCode;
      $products->company_name = $request->company_name;
      $products->MarketedBy = $request->company_name;
      $products->ManufacturerName = $request->manufacturer_name;
      $products->ProductName = $request->product_name;
      $products->SupplierName = $request->supplier_name;
      $products->ItemCategoryID = $categories->id;
      $products->SubCategoryID = $subcategories->id;
      $products->SubCategoryName = $request->sub_category;
      $products->BrandName = $request->brand_name;
      $products->Weight = $request->weight;
      $products->UomID = $request->uomid;
      $products->ItemID = $items->id;
      $products->save();
      Alert::success('Congrats', 'Product Successfully Added');
      return redirect()->back();
    } else {
      Alert::error('Error', 'Some Error Occurred');
      return redirect()->back()->withErrors($validator)->withInput();
    }
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
      $products->is_secondary = $request->secondary;
      $products->ApplicationID = $request->applicationid;
      $products->ProductCode = $request->product_code;
      $products->company_name = $request->company_name;
      $products->ManufacturerName = $request->manufacturer_name;
      $products->ProductName = $request->product_name;
      $products->SupplierName = $request->supplier_name;
      $products->ItemCategoryID = $request->category;
      $products->SubCategoryID = $request->sub_category;
      $products->BrandName = $request->brand_name;
      $products->Weight = $request->weight;
      $products->UomID = $request->uomid;
      $products->save();
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
    $categoryid = $request->input('id');
    $category = Category::select('', '')->where('ApplicationID', $categoryid)->get();
    return response()->json($category);
  }

  public function getProductSubcategory(Request $request) {
    $subcategoryid = $request->input('id');
    $subcategory = SubCategory::where('ApplicationID', $subcategoryid)->get();
    return response()->json($subcategory);
  }
}
