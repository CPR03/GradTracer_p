<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Models\QuestionSection;
class QuestionnaireController extends Controller
{
    function __construct()
    {
        $this->middleware('role_or_permission:Survey access|Permission create|Permission edit|Permission delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Survey create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Survey edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Survey delete', ['only' => ['destroy']]);
    }
    public function create(){
        return view('sidebar.survey.questionnaire.create');
    }

    public function store(Request $req){
        $data = request()->validate([
            'title' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;

        $questionnaire = Questionnaire::create($data);

         return redirect('/admin/questionnaires/'.$questionnaire->id);
    }

    public function show(Questionnaire $questionnaire, QuestionSection $section){
        $idad = $questionnaire->id;
        $questionnairesz = Questionnaire::find($idad);
        $sections = $questionnairesz->load('sections.questions');
        $questionsz = $questionnairesz->load('questions');
     
        $multiple_question = $questionnairesz->load('table_evaluation.multiple_questions');
       
        return view('sidebar.survey.questionnaire.show', compact('questionnaire', 'sections', 'questionsz'));
    }
}
