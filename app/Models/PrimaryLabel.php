<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimaryLabel extends Model {
    use HasFactory;
    // protected $table = 'primary_labels';

    protected $fillable = [
      'product_code',
      'manufacturer_name',
      'supplier_name',
      'category_name',
      'sub_category_name',
      'product_name',
      'brand_name',
      'uom_id',
      'weight',
      'batch_number',
      'serial_number',
      'manufacture_date',
      'expiry_date',
      'qr_code',
      'status',
      'quantity',
      'mrp',

    ];
}

