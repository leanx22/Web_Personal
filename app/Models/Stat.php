<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $attributes = [
        'views'=>0,
        'interactions'=>0    
    ];

    use HasFactory;
    protected $table = "stats";
    public $timestamps = false;
}
