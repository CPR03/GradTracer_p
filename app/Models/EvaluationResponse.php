<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationResponse extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function survey(){
        return $this->belongsTo(Survey::class);
    }
    public function multiple_questions(){
        return $this->belongsTo(MultipleQuestion::class);
    }
    public function multiple_answers(){
        return $this->belongsTo(MultipleAnswer::class);
    }
    public function sections(){
        return $this->belongsTo(QuestionSection::class);
    }
    public function evaluation(){
        return $this->belongsTo(Evaluation::class);
    }

}
