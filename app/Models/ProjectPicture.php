<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectPicture extends Model
{
    use HasFactory;
    
    protected $fillable = ['picture_path'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
