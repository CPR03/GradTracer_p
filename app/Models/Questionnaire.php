<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model

{
    protected $guarded = [];
    public function path(){
        return url('admin/questionnaires/' . $this->id);
    }
    public function result_path(){
        return url('admin/questionnaires/reports/' . $this->id);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function multiple_questions(){
        return $this->hasMany(MultipleQuestion::class);
    }
    
    public function surveys(){
        return $this->hasMany(Survey::class);
    }
    
    public function sections(){
        return $this->hasMany(QuestionSection::class);
    }
    public function table_evaluation(){
        return $this->hasMany(Evaluation::class);
    }
}
