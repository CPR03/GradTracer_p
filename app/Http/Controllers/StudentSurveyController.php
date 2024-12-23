<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentSurveyController extends Controller
{
    public function index()
    {
        $questionnaires = Questionnaire::latest()->get();
        return view('student.sidebar.survey.list', compact('questionnaires'));
    }
    public function store(Questionnaire $questionnaire, Request $request)
{
    try {
        $request->validate([
            'survey.name' => 'required',
            'survey.department' => 'required',
            'responses' => 'required|array'
        ]);

        DB::beginTransaction();

        $survey = $questionnaire->surveys()->create([
            'name' => $request->input('survey.name'),
            'department' => $request->input('survey.department')
        ]);

        foreach ($request->input('responses', []) as $questionId => $response) {
            $question = $questionnaire->questions()->find($questionId);
            
            if (!$question) {
                continue;
            }

            try {
                switch ($question->questionType) {
                    case 'multipleChoice':
                        if (isset($response['answer_id'], $response['answer_name'])) {
                            $survey->responses()->create([
                                'question_id' => $questionId,
                                'answer_id' => $response['answer_id'],
                                'answer_name' => $response['answer_name'],
                                'question_name' => $question->question
                            ]);
                        }
                        break;

                    case 'textBox':
                    case 'simple':
                    case 'date':
                        if (isset($response['answer_name'])) {
                            $survey->responses()->create([
                                'question_id' => $questionId,
                                'answer_id' => null,
                                'answer_name' => $response['answer_name'],
                                'question_name' => $question->question
                            ]);
                        }
                        break;
                }
            } catch (\Exception $e) {
                Log::error('Error processing response', [
                    'questionId' => $questionId,
                    'error' => $e->getMessage()
                ]);
                throw $e;
            }
        }

        DB::commit();
        
        // Redirect to dashboard with success message
        return redirect()->route('dashboard')->with('success', 'Survey submitted successfully');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Survey submission failed', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'message' => 'Failed to submit survey. Please try again.',
            'error' => $e->getMessage()
        ], 500);
    }
}
   
    
}
