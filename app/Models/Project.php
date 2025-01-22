<?php

namespace App\Models;

use App\Models\ProjectPicture;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function pictures()
    {
        return $this->hasMany(ProjectPicture::class);
    }
}
