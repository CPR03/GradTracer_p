<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function survey(){
        return $this->belongsTo(Survey::class);
    }
    public function sections(){
        return $this->belongsTo(QuestionSection::class);
    }
    public function questions(){
        return $this->belongsTo(Question::class);
    }
    public function answers(){
        return $this->belongsTo(Answer::class);
    }
    
}
