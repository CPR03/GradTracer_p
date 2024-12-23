<?php

namespace App\Http\Controllers;
use App\Models\Questionnaire;
use App\Models\QuestionSection;
use Illuminate\Http\Request;

class StudentQuestionnaireController extends Controller
{
    public function show(Questionnaire $questionnaire, QuestionSection $section)
    {

        $idad = $questionnaire->id;
        $questionnairesz = Questionnaire::find($idad);
        $sections = $questionnairesz->load('sections.questions');
        $questionsz = $questionnairesz->load('questions');
        $questionSection = $questionnairesz->load('sections.questions');
        $multiple_question = $questionnairesz->load('table_evaluation.multiple_questions');
        return view('student.sidebar.survey.show', compact('questionnaire', 'sections', 'questionSection'));
    }
}
