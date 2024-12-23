<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function questionnaires(){
        return $this->belongsTo(Questionnaire::class);
    }
    public function sections(){
        return $this->belongsTo(QuestionSection::class);
    }
    public function questions(){
        return $this->belongsTo(Question::class);
    }
    public function table_evaluation(){
        return $this->belongsTo(Evaluation::class);
    }
    public function multiple_answers(){
        return $this->hasMany(MultipleAnswer::class);
    }
    public function eval_responses(){
        return $this->hasMany(EvaluationResponse::class);
    }
}
