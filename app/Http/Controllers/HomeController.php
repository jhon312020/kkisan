<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Product;
use App\Models\PrimaryLabel;
use App\Models\LabelType;
use Auth;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
      $greenLable = LabelType::where('name','=','green')->first();
      $whiteLable = LabelType::where('name','=','white')->first();
      $mediumLable = LabelType::where('name','=','medium')->first();
      $smallLable = LabelType::where('name','=','small')->first();
      $productCount = Product::count(); 
      $green = PrimaryLabel::where('label_type',$greenLable->id)->count();
      $white = PrimaryLabel::where('label_type',$whiteLable->id)->count();
      $medium = PrimaryLabel::where('label_type',$mediumLable->id)->count();
      $small = PrimaryLabel::where('label_type',$smallLable->id)->count();
      $totalCount = $green + $white + $medium + $small;
      return view('home',compact('productCount','green','white','medium','small','totalCount'));
    }

}
