<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',	'quiz_id',	'title'	,'type',	'options'	,'correct_answer',	'mark'	,'created_at'	,'updated_at'

    ];

    protected $casts = [
        'options' => 'array'
    ];


    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }
}
