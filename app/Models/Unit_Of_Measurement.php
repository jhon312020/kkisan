<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit_Of_Measurement extends Model {
    use HasFactory;

    protected $fillable = [

      'name',
      'status',

    ];
}