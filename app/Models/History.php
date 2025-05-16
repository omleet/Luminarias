<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['light', 'temperature', 'led_state','motion','humidity'];

}
