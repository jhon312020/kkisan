<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
  use HasFactory;
  public $timestamps = true;
  protected $fillable = [
    'ApplicationID',
    'ProductCode',
    'ManufacturerName',
    'MarketedBy',
    'is_secondary',
    'LicenseNumber',
    'CIBRegistrationCertificate',
    'SupplierName',
    'ItemCategoryID',
    'SubCategoryID',
    'SubCategoryName',
    'ItemID',
    'ProductName',
    'BrandName',
    'UomID',
    'Weight',
    'company_name',
    'api_sing_status',
    'local_status',
  ];

  protected $with = ['Application','UnitOfMeasurement','Category','SubCategory','Item'];

  public function UnitOfMeasurement() {
    return $this->belongsTo(UnitOfMeasurement::class, 'UomID', 'id');
  }

  public function Application() {
    return $this->belongsTo(Application::class, 'ApplicationID', 'id');
  }

  public function Category() {
    return $this->belongsTo(Category::class, 'ItemCategoryID', 'id');
  }

  public function SubCategory() {
    return $this->belongsTo(SubCategory::class, 'SubCategoryID', 'id');
  }

  public function Item() {
    return $this->belongsTo(Item::class, 'ItemID', 'id');
  }

  public function PrimaryLabel() {
    return $this->hasMany(PrimaryLabel::class);
  }
}