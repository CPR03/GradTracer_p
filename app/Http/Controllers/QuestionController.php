<?php

namespace App\Http\Controllers;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;
class QuestionController extends Controller
{
    public function create(Questionnaire $questionnaire){
        return view('sidebar.survey.question.create', compact('questionnaire'));
    }


    public function store(Questionnaire $questionnaire, Request $request){
        
         $data = request()->validate([
             'question.question' => 'required',
             'question.questionType' => 'required',
             'answers.*.answer' => 'required',
            
         ]);
          $question = $questionnaire->questions()->create($data['question']);
          $question->answers()->createMany($data['answers']);
        // $question = $questionaire->questions()->create($data['question']);
        
        // $question->answers()->createMany($da
    }
    public function destroy(Questionnaire $questionnaire, Question $question){
       $question->answers()->delete();
       $question->delete();

       return redirect($questionnaire->path());
    }
    
    public function edit(Questionnaire $questionnaire, Question $question){
        $question = $question->load('answers');
       
        
        return view('question.edit', ['question' => $question]);
    }
    public function update(Questionnaire $questionnaire, Question $question, Answer $answers, Request $request){
        $test = DB::table('questions')->where('id', $request->id)->update(['question' => $request->input('questions')]);
        $try = DB::table('answers')->where('id', $request->testing)->update(['answer' => $request->input('answers')]);
        return($test);
       
    }
}
