<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralStat extends Model
{
    use HasFactory;
    protected $table = "general_stats";
    protected $fillable = ['visitas','vistas_linkedin','visitas_github','interacciones_contacto'];
    public $timestamps = false;
}
