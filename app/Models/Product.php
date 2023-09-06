<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
  use HasFactory;
  public $timestamps = true;
  protected $fillable = [
    'application_id',
    'product_code',
    'manufacturer_name',
    'marketed_by',
    'secondary',
    'license_number',
    'cib_registration_certificate',
    'supplier_name',
    'category_id',
    'category_name',
    'sub_category_id',
    'sub_category_name',
    'item_id',
    'product_name',
    'brand_name',
    'uom_id',
    'weight',
    'company_name',
    'status',
  ];
}