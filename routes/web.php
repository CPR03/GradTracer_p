<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SurveyController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\QuestionnaireController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentsListController;
use App\Http\Controllers\StudentSurveyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentQuestionnaireController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/dashboard');

Route::get('/dashboard', [StudentDashboardController::class, 'index'])
    ->middleware(['student'])
    ->name('dashboard');

require __DIR__ . '/student_auth.php';


// ADMIN AUTH
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Resource routes
    Route::namespace('App\Http\Controllers\Admin')->name('admin.')->group(function () {
        Route::resource('roles', 'RoleController');
        Route::resource('report', 'ReportController');
        Route::resource('survey', 'SurveyController');
        Route::resource('departments', 'DepartmentController');
        Route::resource('student_lists', 'StudentsListController');
        Route::resource('posts', 'PostController');
        Route::resource('questionnaire', 'QuestionnaireController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('users', 'UserController');
        Route::resource('students', 'FrontuserController');
    });

    // Questionnaire routes
    Route::get('questionnaires/create', [QuestionnaireController::class, 'create']);
    Route::post('questionnaires', [QuestionnaireController::class, 'store']);
    Route::get('questionnaires/{questionnaire}', [QuestionnaireController::class, 'show']);
    Route::delete('questionnaires/{questionnaire}/questions/{question}', [QuestionController::class, 'deleteQuestion'])
        ->name('admin.questions.delete');
    Route::delete('questionnaires/{questionnaire}', [QuestionController::class, 'destroy'])
        ->name('admin.questionnaires.destroy');
    Route::delete(
        'questionnaires/{questionnaire}/evaluation/{evaluation}',
        [QuestionController::class, 'deleteEvaluation']
    )->name('admin.evaluation.delete');

    // Reports and exports
    Route::get('questionnaires/reports/{questionnaire}', [ResultController::class, 'show']);
    Route::get('questionnaires/{questionnaire}/export', [ResultController::class, 'export'])
        ->name('admin.questionnaires.export');
    Route::get('file-export', [ReportController::class, 'fileExport'])->name('file-export');

    // Question management routes
    Route::get('questionnaires/{questionnaire}/{section}/questions/create', [QuestionController::class, 'createQS']);
    Route::get('questionnaires/{questionnaire}/questions/section', [QuestionController::class, 'create']);
    Route::post('questionnaires/{questionnaire}/questions', [QuestionController::class, 'store']);
    Route::post('questionnaires/{questionnaire}/sections', [QuestionController::class, 'section']);
    Route::get('questionnaires/{questionnaire}/{section}/{question}/edit', [QuestionController::class, 'edit']);
    Route::get('questionnaires/{questionnaire}/{question}/{answer}/viewAS', [QuestionController::class, 'viewAnswer']);
    Route::put('questionnaires/{question}/{answer}/{section}/update', [QuestionController::class, 'update']);
    Route::put('admin/questionnaires/{questionnaire}/{section}/{question}/questionUp', [QuestionController::class, 'questionUp'])
        ->name('admin.questions.update');

    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])
        ->name('admin.departments.destroy');
});

Route::namespace('App\Http\Controllers')->name('student.')->prefix('student')
    ->middleware(['student'])
    ->group(function () {
        Route::resource('survey', 'StudentSurveyController');
    });

// Export
// Route::get('/admin/questionnaires/{questionnaire}/export', [ResultController::class, 'export'])
//     ->name('admin.questionnaires.export');

Route::middleware(['student'])->group(function () {
    Route::get('student/questionnaires/{questionnaire}', [StudentQuestionnaireController::class, 'show']);
    Route::get('/surveys/{questionnaire}-{slug}', [StudentSurveyController::class, 'show']);
    Route::post('/student/surveys/{questionnaire}-{slug}', [StudentSurveyController::class, 'store']);

    // Profile routes
    Route::get('student/profile/{student_id}', [ProfileController::class, 'index']);
    Route::get('student/profile/edit/{student_id}', [ProfileController::class, 'edit']);
    Route::put('student/profile/update/{student_id}', [ProfileController::class, 'update']);
});

// Route::get('student/questionnaires/{questionnaire}', [StudentQuestionnaireController::class, 'show']);
// Route::get('/surveys/{questionnaire}-{slug}', [StudentSurveyController::class, 'show']);
// Route::post('/student/surveys/{questionnaire}-{slug}', [StudentSurveyController::class, 'store']);

// Route::get('student/profile/{student_id}', [ProfileController::class, 'index']);
// Route::get('student/profile/edit/{student_id}', [ProfileController::class, 'edit']);
// Route::put('student/profile/update/{student_id}', [ProfileController::class, 'update']);

// Route::get('admin/questionnaires/{questionnaire}/{section}/questions/create', [QuestionController::class, 'createQS']);
// Route::get('admin/questionnaires/{questionnaire}/questions/section', [QuestionController::class, 'create']);
// Route::post('admin/questionnaires/{questionnaire}/questions', [QuestionController::class, 'store']);
// Route::post('admin/questionnaires/{questionnaire}/sections', [QuestionController::class, 'section']);
// Route::get('admin/questionnaires/{questionnaire}/{section}/{question}/edit', [QuestionController::class, 'edit']);
// Route::get('/admin/questionnaires/{questionnaire}/{question}/{answer}/viewAS', [QuestionController::class, 'viewAnswer']);
// Route::put('/admin/questionnaires/{question}/{answer}/{section}/update', [QuestionController::class, 'update']);
// Route::put('/admin/questionnaires/{sections}/{questionnaire}/{question}/questionUp', [QuestionController::class, 'questionUp']);

// Route::post('/questionaires/{question}/questions/edit', [QuestionController::class,'update']);

Route::group(['middleware' => 'auth', 'prefix' => 'messages', 'as' => 'messages'], function () {
    Route::get('/', [MessagesController::class, 'index']);
    Route::get('create', [MessagesController::class, 'create'])->name('.create');
    Route::post('/', [MessagesController::class, 'store'])->name('.store');
    Route::get('{thread}', [MessagesController::class, 'show'])->name('.show');
    Route::put('{thread}', [MessagesController::class, 'update'])->name('.update');
    Route::delete('{thread}', [MessagesController::class, 'destroy'])->name('.destroy');
});

// Route::get('student/step-1', [SectionsController::class, 'create-step-1'])->name('step1');
// Route::get('student/step-2', [SectionsController::class, 'create-step-2'])->name('step2');
// Route::get('student/step-3', [SectionsController::class, 'create-step-3'])->name('step3');
// Route::get('student/step-4', [SectionsController::class, 'create-step-4'])->name('step4');
// Route::get('student/step-5', [SectionsController::class, 'create-step-5'])->name('step5');
// Route::get('student/step-6', [SectionsController::class, 'create-step-6'])->name('step6');
// Route::get('student/step-7', [SectionsController::class, 'create-step-7'])->name('step7');
// Route::get('student/step-8', [SectionsController::class, 'create-step-8'])->name('step8');
// Route::get('student/step-9', [SectionsController::class, 'create-step-9'])->name('step9');

// Route::post('student/step-1', [SectionsController::class, 'post-step-1'])->name('step1');
// Route::post('student/step-2', [SectionsController::class, 'post-step-2'])->name('step2');
// Route::post('student/step-3', [SectionsController::class, 'post-step-3'])->name('step3');
// Route::post('student/step-4', [SectionsController::class, 'post-step-4'])->name('step4');
// Route::post('student/step-5', [SectionsController::class, 'post-step-5'])->name('step5');
// Route::post('student/step-6', [SectionsController::class, 'post-step-6'])->name('step6');
// Route::post('student/step-7', [SectionsController::class, 'post-step-7'])->name('step7');
// Route::post('student/step-8', [SectionsController::class, 'post-step-8'])->name('step8');
// Route::post('student/step-9', [SectionsController::class, 'post-step-9'])->name('step9');

require __DIR__ . '/auth.php';
