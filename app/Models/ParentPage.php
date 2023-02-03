<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentPage extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function childpages()
    {
        return $this->hasMany(ChildPage::class);
    } 
}
