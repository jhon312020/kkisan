<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Vote;
use App\Models\products;
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

class ProductController extends Controller {
  // public function index(Request $request) {
  //   $search = $request['search'] ?? "";
  //   if ($search != "") {
  //       $products = Product::where('name', 'LIKE', "%$search%")
  //                   ->orWhere('code', 'LIKE', "%$search%")->paginate(10);
  //   } else {
  //       $products = Product::paginate(10);
  //   }
  //   $data = compact('products','search');
  //   return view('/productHome')->with($data);
  // }

  public function index() {
    $products = Product::paginate(10);
    return view('/productHome',['products' => $products]);
  }

  function fetchAPIData($requestURL) { 
    $apiURL = "https://kkisan.karnataka.gov.in/KKISANQRAPI/api/";
    $dataURL = $apiURL.$requestURL;
    $ch = curl_init($dataURL);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $contents = curl_exec($ch);
    if ($contents === false) {
      // echo 'Curl error: ' . curl_error($ch);
    } else {
      echo 'Operation completed without any errors';
    }

    $data = json_decode($contents);
    curl_close($ch);
    return $data;
  }

  public function create() {
    $guoms = $this->fetchAPIData('GetUnitOfMeasurements');
    $applications = $this->fetchAPIData('Master/GetKKISANApplications');
    $categories = $this->fetchAPIData('Master/GetItemCategory?ApplicationID=FL');
    $subcategories = $this->fetchAPIData('Master/GetItemSubCategory?ApplicationID=FL');
    $item = $this->fetchAPIData('Master/GetItemDetail?ApplicationID=FL');
    // exit;
    // echo '<pre>';
    // print_r(fetchAPIData('GetUnitOfMeasurements'));
    // print_r(fetchAPIData('Master/GetKKISANApplications'));
    // print_r(fetchAPIData('Master/GetItemCategory?ApplicationID=FL'));
    // print_r(fetchAPIData('Master/GetItemSubCategory?ApplicationID=FL'));
    // print_r(fetchAPIData('Master/GetItemDetail?ApplicationID=FL'));
    // echo '</pre>'; 
    return view('products.create',compact('guoms','applications','categories','subcategories','item'));
  }

  public function store(Request $request) {
    $guoms = $this->fetchAPIData('GetUnitOfMeasurements');
    $applications = $this->fetchAPIData('Master/GetKKISANApplications');
    $categories = $this->fetchAPIData('Master/GetItemCategory?ApplicationID=FL');
    $subcategories = $this->fetchAPIData('Master/GetItemSubCategory?ApplicationID=FL');
    $item = $this->fetchAPIData('Master/GetItemDetail?ApplicationID=FL');
    $searchCategoryName = $request->category;
      $itemCategoryId = null;
      foreach ($categories as $item) {
          if ($item->ItemCategoryName == $searchCategoryName) {
              $itemCategoryId = $item->ItemCategoryID;
              break;
          }
      }
      $searchSubCategoryName = $request->sub_category;
      $subCategoryId = null;
      foreach ($subcategories as $item) {
          if ($item->SubCategoryName == $searchSubCategoryName) {
              $subCategoryId = $item->SubCategoryID;
              break;
          }
      }
      $productcode = rand(10000000000000, 99999999999999);
      // if ($itemCategoryId !== null) {
      //     echo "ItemCategoryID: " . $itemCategoryId;
      // } else {
      //     echo "SubCategory not found.";
      // }
      // dd($request->all());
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
      $products->secondary = $request->secondary;
      $products->application_id = $request->applicationid;
      $products->product_code = $productcode;
      $products->company_name = $request->company_name;
      $products->manufacturer_name = $request->manufacturer_name;
      $products->product_name = $request->product_name;
      $products->supplier_name = $request->supplier_name;
      $products->category_id = $itemCategoryId;
      $products->category_name = $request->category;
      $products->sub_category_id = $subCategoryId;
      $products->sub_category_name = $request->sub_category;
      $products->brand_name = $request->brand_name;
      $products->weight = $request->weight;
      $products->uom_id = $request->uomid;
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
    if( $validator->passes() ) {
      $products = Product::find($id);
      $products->secondary = $request->secondary;
      $products->applicationid = $request->applicationid;
      $products->product_code = $request->product_code;
      $products->company_name = $request->company_name;
      $products->manufacturer_name = $request->manufacturer_name;
      $products->product_name = $request->product_name;
      $products->supplier_name = $request->supplier_name;
      $products->category = $request->category;
      $products->sub_category = $request->sub_category;
      $products->brand_name = $request->brand_name;
      $products->weight = $request->weight;
      $products->uomid = $request->uomid;
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

  // public function deletetype(Request $request){
  //   $ids = $request->ids;
  //   Type::whereIn('id', $ids)->delete();
  //   Alert::success('Success', 'Bus Type Deleted Successfully');
  //   return redirect()->back();
  // }

  public function deleteproduct(Request $request){
    $ids = $request->ids;
    $product = Product::whereIn('id', $ids)->get();
    Product::whereIn('id', $ids)->delete();
    Alert::success('Success', 'Product Deleted Successfully');
    return redirect()->back();
  }
}
