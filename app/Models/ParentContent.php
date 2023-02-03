<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentContent extends Model
{
    use HasFactory;

 protected $fillable= [
        "parentpage_id","text","Thumbnailimg"
    ];
    public function parentpage()
    {
      return $this->belongsTo(ParentPage::class);
    }
}
