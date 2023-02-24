<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'type', 'rule'
    ];

    protected function rule(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => json_decode($value,2)
        );
    }


    public function plan()
    {
        return $this->belongsTo(Plane::class);
    }
}
