<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
  protected $table = 'general_settings';

  protected $fillable = [
    'CompanyName','Address','Phone','Phone2','Email','Code','Plot','Country','Currency','Logo','Crumb'
  ];
}
