<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Project extends Model
{
    use HasFactory;
    protected $table = "projects";
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected function slug():Attribute
    {
        return new Attribute(
            set: function($value){
                return strtolower($value);
            }
        );
    }

}
