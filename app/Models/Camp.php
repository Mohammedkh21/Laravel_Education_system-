<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Camp extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name', 'location', 'created_at','updated_at'
    ];

    public function admins()
    {
        return $this->morphedByMany(Admin::class, 'campable')->withTimestamps();
    }

    public function teachers()
    {
        return $this->morphedByMany(Teacher::class, 'campable')->withTimestamps();
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

}
