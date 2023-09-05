<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secondary_Label extends Model {
    use HasFactory;

    protected $fillable = [

      'product_code',
      'batch_number',
      'serial_number',
      'manufacture_date',
      'expiry_date',
      'qr_code',
      'status',

    ];
}
