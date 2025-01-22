<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['heading', 'description', 'date', 'users','type_of','label'];

    // Define the relationship with employees
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
