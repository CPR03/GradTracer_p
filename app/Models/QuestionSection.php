<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSection extends Model
{
    use HasFactory;
    public $guarded = [];

    public function questions(){
        return $this->hasMany(Question::class);
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }
    public function multiple_questions(){
        return $this->hasMany(MultipleQuestion::class);
    }
    public function questionnaire(){
        return $this->belongsTo(Questionnaire::class);
    }
    public function table_evaluation(){
        return $this->hasMany(Evaluation::class);
    }
    public function surveys(){
        return $this->hasMany(Survey::class);
    }
    public function responses(){
        return $this->hasMany(SurveyResponse::class);
    }
    public function eval_responses(){
        return $this->hasMany(EvaluationResponse::class);
    }
}
