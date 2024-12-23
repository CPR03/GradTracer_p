<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function questions(){
        return $this->belongsTo(Question::class);
    }
    public function answers(){
        return $this->belongsTo(Answer::class);
    }
    public function responses(){
        return $this->hasMany(SurveyResponse::class);
    }
    
}
