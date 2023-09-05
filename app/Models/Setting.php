<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
    use HasFactory;

     protected $fillable = [

      'logo',
      'favicon',
      'footer_copyright',
      'contact_address',
      'contact_email',
      'contact_phone',
      'contact_fax',
      'contact_map_iframe',
      'receive_email',
      'receive_email_subject',
      'receive_email_thank_you_message',
      'meta_title_home',

    ];
}
