<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleAnswer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function multiple_question(){
        return $this->belongsTo(MultipleQuestion::class);
    }
    public function table_evaluation(){
        return $this->belongsTo(Evaluation::class);
    }
    public function eval_responses(){
        return $this->hasMany(EvaluationResponse::class);
    }
    public function sections(){
        return $this->belongsTo(QuestionSection::class);
    }
}
