<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleriesRoom extends Model
{
    use HasFactory;
    protected $fillable= [
        "category","name","image","caption","child_pages_id"
      ];
}
