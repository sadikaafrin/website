<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'phone', 'address', 'google_map', 'facebook', 'instagram', 'linkedin', 'twitter', 'youtube'];

}






