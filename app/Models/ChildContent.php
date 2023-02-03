<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildContent extends Model
{
    use HasFactory;
    public function childpage()
    {
      return $this->belongsTo(ChildPage::class);
    }
}
