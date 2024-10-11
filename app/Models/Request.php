<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','type','data','created_at','updated_at'
    ];
    protected $casts = [
        'data' => 'json',
    ];

    public function getDataAttribute($value)
    {
        return json_decode($value); // Decode the JSON string to an object
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
