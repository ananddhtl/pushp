<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildPage extends Model
{
    use HasFactory;

    public function parentpage()
    {
        return $this->belongsTo(ParentPage::class, 'parentpage_id');
    }
}
