<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'question',
        'questionType',
        'questionnaire_id',
        'question_section_id'
    ];
    public function questionnaires(){
        return $this->belongsTo(Questionnaire::class);
    }
    public function sections(){
        return $this->belongsTo(QuestionSection::class);
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }
    public function multiple_questions(){
        return $this->hasMany(MultipleQuestion::class);
    }
    public function multiple_answers(){
       return $this->hasMany(MultipleAnswer::class);
    } 
    public function responses(){
        return $this->hasMany(SurveyResponse::class);
    }
}
