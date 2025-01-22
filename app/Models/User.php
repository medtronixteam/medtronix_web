<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Increment;
 use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    // Other code...
    use HasFactory, HasApiTokens,Notifiable;


    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function salarySlips()
    {
        return $this->hasMany(SalarySlip::class, 'employee_id', 'id');
    }

    // public function salarySlips()
    // {
    //     return $this->hasMany(SalarySlip::class);
    // }

    public function increments()
    {
        return $this->hasMany(Increment::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

}
