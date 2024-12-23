<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $guarded = [];

       /**
     * Get the student that owns the survey response
     */
    public function student()
    {
        return $this->belongsTo(Students::class, 'name', 'name');
    }

    public function questionnaire(){
        return $this->belongsTo(Questionnaire::class);
    }
    public function responses(){
        return $this->hasMany(SurveyResponse::class);
    }
    public function sections(){
        return $this->belongsTo(QuestionSection::class);
    }
    public function evaluation_response(){
        return $this->hasMany(EvaluationResponse::class);
    }
}
