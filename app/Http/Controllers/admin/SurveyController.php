<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Questionnaire;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    function __construct()
    {
        $this->middleware('role_or_permission:Survey access|Permission create|Permission edit|Permission delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Survey create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Survey edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Survey delete', ['only' => ['destroy']]);
    }
    public function index(){
        $questionnaires = Questionnaire::latest()->get();

        return view('sidebar.survey.questionnaire.list', compact('questionnaires'));
    }



    public function create(Questionnaire $questionnaire){
        $questionnaire_id = Questionnaire::latest()->get();
        return view('sidebar.survey.create', compact('questionnaire_id'));
    }

    public function store(Questionnaire $questionnaire){
        return($questionnaire);
        //  $questionnaire_id = Questionnaire::latest()->get();

        //  $data = request()->validate([
        //      'question.question' => 'required',
        //      'question.questionType' => 'required',
        //      'answers.*.answer' => 'required',

        //  ]);
        //  $question = $questionnaire_id ->questions()->create($data['question']);
        //  $question->answers()->createMany($data['answers']);





        //  return view('sidebar.survey.index');
    }
}
