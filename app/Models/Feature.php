<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable =[
        'name', 'slug','type','rule'
    ];


    public function plan()
    {
        return $this->belongsTo(Plane::class);
    }
}
