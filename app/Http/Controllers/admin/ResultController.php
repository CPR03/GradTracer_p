<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Models\QuestionSection;
use App\Models\Question;
use App\Models\Survey;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SurveyExport;

class ResultController extends Controller
{
    function __construct()
    {
        $this->middleware('role_or_permission:Survey access|Permission create|Permission edit|Permission delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Survey create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Survey edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Survey delete', ['only' => ['destroy']]);
    }

    public function show(Questionnaire $questionnaire)
    {
        $sections = $questionnaire->load('sections.questions.answers.responses');
        $surveys = $questionnaire->load('surveys.responses');
        $evaluations = $questionnaire->load([
            'table_evaluation.multiple_questions.multiple_answers',
            'table_evaluation.multiple_questions.eval_responses', // Add this line
            'surveys.evaluation_response'
        ]);

        // Count total surveys and completed surveys
        $totalResponses = $surveys->surveys->count();
        $completedResponses = $surveys->surveys->filter(function ($survey) {
            return $survey->responses->isNotEmpty() || $survey->evaluation_response->isNotEmpty();
        })->count();

        $completionRate = $totalResponses > 0 ? ($completedResponses / $totalResponses) * 100 : 0;

        return view('sidebar.reports.show', compact(
            'questionnaire',
            'sections',
            'surveys',
            'evaluations',
            'totalResponses',
            'completionRate'
        ));
    }

    public function export(Questionnaire $questionnaire)
    {
        $sections = $questionnaire->load('sections.questions.answers.responses');
        $surveys = $questionnaire->load('surveys.responses');
        $evaluations = $questionnaire->load([
            'table_evaluation.multiple_questions.eval_responses',
            'table_evaluation.multiple_questions'
        ]);

        return Excel::download(
            new SurveyExport($sections, $surveys, $evaluations),
            $questionnaire->title . ' - Survey Results.xlsx'
        );
    }
}
