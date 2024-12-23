<?php

namespace App\Http\Controllers\admin;

use App\Models\Questionnaire;
use App\Models\Question;
use App\Models\MultipleQuestion;
use App\Models\QuestionSection;
use App\Models\Answer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    function __construct()
    {

        $this->middleware('role_or_permission:Survey access|Permission create|Permission edit|Permission delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Survey create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Survey edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Survey delete', ['only' => ['destroy']]);
    }

    public function create(Questionnaire $questionnaire)
    {
        // Load sections and questions for the current questionnaire
        $sections = $questionnaire->load('sections.questions');

        return view('sidebar.survey.question.section', compact('questionnaire', 'sections'));
    }

    public function createQS(Questionnaire $questionnaire, QuestionSection $section)
    {
        $QsID = $questionnaire->id;
        $test = $section->id;
        $products = Questionnaire::find($QsID);
        $questionSec_ID = QuestionSection::find($test);
        $sections = $products->load('sections.questions');

        return view('sidebar.survey.question.create', compact('questionnaire', 'sections', 'questionSec_ID'));
    }

    public function section(Questionnaire $questionnaire)
    {
        $data = request()->validate([
            'section_name' => 'required',

        ]);
        $question = $questionnaire->sections()->create($data);

        return redirect('/admin/questionnaires/' . $questionnaire->id);
    }

    public function store(Questionnaire $questionnaire, MultipleQuestion $multipleQuestion, Request $request)
    {
        $questionType = request('question.questionType');

        // logging to debug
        Log::info('Starting store method', [
            'questionType' => $questionType,
            'request_data' => $request->all()
        ]);

        // For multiple choice (radio)
        if ($questionType == 'multipleChoice') {
            $data = request()->validate([
                'question.questionnaire_id' => 'required',
                'question.question_section_id' => 'required',
                'question.question' => 'required',
                'question.questionType' => 'required',
                'answers' => 'required|array',
                'answers.*.answer' => 'required'
            ]);

            $question = $questionnaire->questions()->create($data['question']);
            $question->answers()->createMany($data['answers']);

            return redirect('/admin/questionnaires/' . $questionnaire->id);
        } else if ($questionType == 'checkDup' || $questionType == 'check') {
            // For multiple choice (multiple answer)
            Log::info('Processing check type question', [
                'request_data' => request()->all()
            ]);

            $data = request()->validate([
                'question.questionnaire_id' => 'required',
                'question.question_section_id' => 'required',
                'question.question' => 'required',
                'question.questionType' => 'required',
                'answers' => 'required|array',
                'answers.*.answer' => 'required'
            ]);

            Log::info('Check validation passed', [
                'validated_data' => $data,
                'answers' => $data['answers']
            ]);

            $question = $questionnaire->questions()->create($data['question']);
            $question->answers()->createMany($data['answers']);

            Log::info('Check question created', [
                'question_id' => $question->id
            ]);

            return redirect('/admin/questionnaires/' . $questionnaire->id);
        }
        // For rating grid
        else if ($questionType == 'multipleRadio') {
            $data = request()->validate([
                'question.questionnaire_id' => 'required',
                'question.question_section_id' => 'required',
                'question.question' => 'required',
                'question.questionType' => 'required',
                'question_row.*.question_row' => 'required',
            ]);

            // Create only the evaluation record
            $evaluation = $questionnaire->table_evaluation()->create([
                'question_section_id' => $data['question']['question_section_id'],
                'question' => $data['question']['question'],
                'questionType' => 'multiple_question'
            ]);

            // Create grid rows
            foreach ($data['question_row'] as $row) {
                DB::table('multiple_questions')->insert([
                    'questionnaire_id' => $data['question']['questionnaire_id'],
                    'evaluation_id' => $evaluation->id,
                    'question_section_id' => $data['question']['question_section_id'],
                    'question_row' => $row['question_row'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            return redirect('/admin/questionnaires/' . $questionnaire->id);
        }
        // For text, simple, date inputs
        else {
            $data = request()->validate([
                'question.questionnaire_id' => 'required',
                'question.question_section_id' => 'required',
                'question.question' => 'required',
                'question.questionType' => 'required',
            ]);

            $question = $questionnaire->questions()->create($data['question']);

            // Create single answer placeholder
            $answer = ['answer' => 'Answer goes here'];
            $question->answers()->create($answer);
        }

        return redirect('/admin/questionnaires/' . $questionnaire->id);
    }

    public function deleteQuestion(Questionnaire $questionnaire, Question $question)
    {
        if ($question->questionnaire_id !== $questionnaire->id) {
            abort(404);
        }

        // Delete related answers first
        $question->answers()->delete();
        $question->delete();

        // Redirect back to questionnaire
        return redirect($questionnaire->path())->with('success', 'Question deleted successfully');
    }

    public function deleteEvaluation(Questionnaire $questionnaire, $evaluationId)
    {
        $evaluation = DB::table('evaluations')->where('id', $evaluationId)->first();

        if (!$evaluation) {
            abort(404);
        }

        // Delete related multiple questions first
        DB::table('multiple_questions')
            ->where('evaluation_id', $evaluationId)
            ->delete();

        DB::table('evaluations')
            ->where('id', $evaluationId)
            ->delete();

        return redirect()->back()
            ->with('success', 'Rating grid deleted successfully');
    }

    public function destroy(Questionnaire $questionnaire)
    {
        // Delete all related records
        $questionnaire->questions()->each(function ($question) {
            $question->answers()->delete();
        });
        $questionnaire->questions()->delete();
        $questionnaire->sections()->delete();

        // Delete the questionnaire
        $questionnaire->delete();

        return redirect()->route('admin.survey.index')
            ->with('success', 'Questionnaire deleted successfully');
    }

    public function edit(Questionnaire $questionnaire, QuestionSection $section, Question $question, Answer $answer)
    {

        $QsID = $questionnaire->id;
        $test = $section->id;
        $qsTest = $question->id;
        $products = Questionnaire::find($QsID);
        $questionSec_ID = QuestionSection::find($test);
        $answer_find = Answer::find($qsTest);
        $sections = $products->load('sections.questions');

        $answer = DB::table('answers')->where('question_id', $qsTest)->get();

        $section = QuestionSection::find($test);

        return view('sidebar.survey.questionnaire.edit', compact('questionnaire', 'sections', 'question', 'qsTest', 'answer', 'section'));
    }
    public function viewAnswer(Questionnaire $questionnaire, QuestionSection $section, Question $question, Answer $answer, Request $request)
    {
        $QstID = $questionnaire->id;
        $AsID = $answer->id;
        $QSID = $question->id;
        $questionnaire_find = Questionnaire::find($QstID);
        $answer_find = Answer::find($AsID);
        $question_find = Question::find($QSID);
        $sections = $questionnaire_find->load('sections.questions');
        // $test = DB::table('answers')->where('id', $request->id)->update([
        //     'answer'=>$request->input('answers'),
        // ]);
        // return($question_find);
        return view('sidebar.survey.question.edit', compact('answer_find', 'question_find', 'question', 'answer', 'sections'));
    }
    public function update(Question $question, Answer $answer, Request $request)
    {
        $AsID = $answer->id;
        $answer_find = Answer::find($AsID);
        $test = DB::table('answers')->where('id', $answer_find->id)->update([
            'answer' => $request->input('answers'),
            'section_name' => $request->input('answer_section_name'),
        ]);
        return redirect()->back();


        //  $test = DB::table('questions')->where('id', 41)->update(['question' => $request->input('question.question')]);
        //   $answer = DB::table('answers')->where('question_id', 41)->get();
        // $answers = DB::table('answers')->where('id', 139)->where('question_id', 41)->update(['answer' => $request->input('answers.*.answer')]);
        // $try = DB::table('answers')->where('id', $request->testing)->update(['answer' => $request->input('answers')]);
        // $data = request()->validate([
        //     'question.questionnaire_id' => 'nullable',
        //     'question.question_section_id' => 'nullable',
        //     'question.question' => 'nullable',
        //     'question.questionType' => 'nullable',
        //     'answers.*.answer' => 'nullable',
        // $data = request()->validate([
        //     'answers.*.answer' => 'nullable'
        // ]);

        // return($as->id);
        // return(count($data['answers']));
        // return($data);
        // return($answer->id);
        //$answers = DB::table('answers')->whereIn('id', [139, 140])->where('question_id', 41)->update(array('answer'=> $data['answers'][$count[i]]['answer']));

        //$answers = DB::table('answers')->whereIn('id', [139, 140])->where('question_id', 41)->update(array('answer'=> $data['answers']['.*.']['answer']));
        //    return($data['answers']);
        //$answer = DB::table('answers')->where('question_id', 41)->update(['answer'=>$request->input('answers.*.answer'),]);

        // ]);
        // $question = $questionnaire->questions()->update($data['question']);

        // $question->load('answers');
        // return($question);
        // $question->answers()->where('question_id', $request->id)->update(array('answer' => $data['answers']));
        // return($question->load('answers'));
        // $names = $request->get('answers');
        // foreach($names as $key => $value) {
        //  $try = DB::table('answers')->where('question_id', $request->id)->update([
        //      'answer' => $names[$key]
        //  ]);
        //     // DB::table('answers')->where('id', $request->testing)->orWhere('question_id', $request->id)->update([
        //     //     'answer' => $request->input('answers')[$key],
        //     //]);

        //    // return( DB::table('answers')->where('id', $request->testing)->orWhere('question_id', $request->id)->get());




        //     $find = Answer::all();
        //     $data = request()->validate([
        //         'answers.*.answer' => 'required',
        //     ]);
        //     $asd = $find->where('answer', $data['answers']);
        //    $imp = array($data['answers']);
        //     return($data['answers']);


        // $res = DB::table('answers')->where('question_id', $request->id)->get();
        // return($res);

        //     DB::table('answers')->where('question_id', $request->id)
        //     ->update([
        //     'answer' => $request->input('answers.*.answer')
        // ]);

        //    $data = request()->validate([
        //        'answers.*.answer' => 'required',

        //    ]);
        // // // $find = Answer::where('question_id', $request->id)->saveMany(['answer'=>$data['answers']]);
        // // Answer::table('question_id', '=', $request->id)
        // // ->update(['answer' => $data['answers']]);
        // $posts = Answer::whereBelongsTo($question)->get();
        // for ($i=0; $i<count($posts); $i++){
        //     $find = Answer::where('question_id', $request->id)->get();
        //     return($find);
        // }
        //return($data['answers']);

        // // return($find);
        //  $posts = Answer::whereBelongsTo($question)->get('answer')->update(['answer' => $data['answers']]);
        //  return($posts);
        // $devices = $request->device_id;
        // $names = $request->answers;

        // foreach ($names as $key => $name) {
        //     $devicesS[] = Answer::get()->update([
        //         'answer' => $name
        //     ]);
        //     return($devicesS);
        // }
    }

    public function questionUp(Questionnaire $questionnaire, QuestionSection $section, Question $question, Request $request)
    {
        // Validate request
        $request->validate([
            'questions' => 'required',
            'question.questionType' => 'required',
            'answers.*.answer' => $request->has('answers') ? 'required|string' : '',
        ], [
            'answers.*.answer.required' => 'Answer options cannot be empty'
        ]);

        // Update question
        $question->update([
            'question' => $request->input('questions'),
            'questionType' => $request->input('question.questionType')
        ]);

        // Handle answers based on question type
        switch ($request->input('question.questionType')) {
            case 'multipleChoice':
            case 'check':
                if ($request->has('answers')) {
                    // Get existing answer IDs
                    $existingAnswerIds = $question->answers()->pluck('id')->toArray();

                    // Get submitted answer IDs
                    $submittedAnswerIds = collect($request->input('answers'))
                        ->pluck('id')
                        ->filter()
                        ->toArray();

                    // Delete removed answers
                    $deletedAnswerIds = array_diff($existingAnswerIds, $submittedAnswerIds);
                    if (!empty($deletedAnswerIds)) {
                        $question->answers()->whereIn('id', $deletedAnswerIds)->delete();
                    }

                    // Update or create answers
                    foreach ($request->input('answers') as $index => $answerData) {
                        if (!empty($answerData['answer'])) {
                            if (!empty($answerData['id'])) {
                                // Update existing answer
                                $question->answers()->where('id', $answerData['id'])
                                    ->update(['answer' => $answerData['answer']]);
                            } else {
                                // Create new answer
                                $question->answers()->create([
                                    'answer' => $answerData['answer']
                                ]);
                            }
                        }
                    }
                }
                break;

            case 'textBox':
            case 'simple':
            case 'date':
                $question->answers()->delete();
                $question->answers()->create(['answer' => '']);
                break;
        }

        return redirect("/admin/questionnaires/{$questionnaire->id}")
            ->with('success', 'Question updated successfully');
    }
}
