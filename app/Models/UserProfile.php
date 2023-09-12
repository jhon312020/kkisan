<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model {
  use HasFactory;

  public $timestamps = true;
  protected $table = 'user_profiles';
  protected $fillable = [
    'phone',
    'company_name',
    'company_address',
    'company_district',
    'company_state',
    'company_pincode',
    'address',
    'vendor_id',
    'LicenseNumber',
    'CIBRegistrationCertificate',
    'profile_pic',
    'access_token',
    'issued',
    'expires',
  ];

  public function User() {
    return $this->hasMany(User::class);
  }
}
