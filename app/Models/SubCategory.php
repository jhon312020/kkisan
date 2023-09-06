<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model {
  use HasFactory;
  protected $fillable = [
    'name',
    'item_category_id',
    'sub_category_id',
    'status',
  ];
}
