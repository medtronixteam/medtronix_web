<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'team_lead_id',
        // Remove 'members' from fillable since it's no longer needed
    ];

    public function teamLead()
    {
        return $this->belongsTo(User::class, 'team_lead_id');
    }

    // Define the inverse relationship with users
    public function members()
    {
        return $this->hasMany(User::class);
    }
}

