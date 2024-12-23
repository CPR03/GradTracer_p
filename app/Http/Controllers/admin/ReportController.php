<?php

namespace App\Http\Controllers\admin;
use App\Models\Survey;
use App\Models\SurveyResponse;
use App\Models\Questionnaire;
use App\Models\Question;
use App\Models\QuestionSection;
use App\Models\Answer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ResponseExport;
use Illuminate\Support\Facades\DB;
class ReportController extends Controller
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
        return view('sidebar.reports.list', compact('questionnaires'));
    }

}
