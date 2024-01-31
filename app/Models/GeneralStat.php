<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralStat extends Model
{
    use HasFactory;
    protected $table = "general_stats";
    public $timestamps = false;
}
