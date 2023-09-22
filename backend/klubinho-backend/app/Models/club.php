<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class club extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'club_name',
        'banner',
    ];


    
}
