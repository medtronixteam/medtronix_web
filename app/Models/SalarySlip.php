<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySlip extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    protected $casts = [
        'other_allowance' => 'array',
        'other_deduction' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
