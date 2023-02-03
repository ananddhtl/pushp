<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Mail\NewMail;

class Contact extends Model
{
    use HasFactory;

    public $fillable = ['fname', 'lname', 'email', 'message'];
    public static function boot() {
  
        parent::boot();
  
        static::created(function ($item) {
                
            $adminEmail = "info@pec.edu.np";
            Mail::to($adminEmail)->send(new NewMail($item));
        });
}}
