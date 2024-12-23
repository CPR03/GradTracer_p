<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Students;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        $users = Students::latest()->get();
        $pendingSurveys = Questionnaire::count();

        return view('student.dashboard', [
            'users' => $users,
            'posts' => $posts,
            'pendingSurveys' => $pendingSurveys
        ]);
    }
}
