<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function questionnaires(){
        return $this->belongsTo(Questionnaire::class);
    }
    public function sections(){
        return $this->belongsTo(QuestionSection::class);
    }
    public function multiple_questions(){
        return $this->hasMany(MultipleQuestion::class);
    }
    public function eval_responses(){
        return $this->hasMany(EvaluationResponse::class);
    }

}
