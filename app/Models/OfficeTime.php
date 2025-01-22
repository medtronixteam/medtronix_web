<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeTime extends Model
{
    
    protected $table = 'office_times';

    protected $fillable = [
        'open_time',
        'close_time',
        'max_reporting_time',
        'min_reporting_time',
    ];

    // You can define any additional logic or relationships here
}
