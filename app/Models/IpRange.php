<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpRange extends Model
{
    protected $fillable = ['network_ip', 'network_name'];
    use HasFactory;
}
