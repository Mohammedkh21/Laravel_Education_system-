<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable =[
      'id','result','created_at','updated_at'
    ];

    public function gradeable()
    {
        return $this->morphTo();
    }
}
