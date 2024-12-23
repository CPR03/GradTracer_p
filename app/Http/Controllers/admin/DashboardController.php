<?php

namespace App\Http\Controllers\admin;

use App\Models\Students;
use App\Models\Department;
use App\Models\Questionnaire;
use App\Models\Survey;
use App\Models\SurveyResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(Questionnaire $questionnaire)
    {
        // Department course mapping
        $departmentCourses = [
            'ccms' => ['BSIT', 'BSIS', 'BSCS', 'BSEMC'],
            'ceng' => ['BSEE', 'BSCPE', 'BSIE', 'BSGD'],
            'cba' => ['BSBA', 'BSA', 'BSMA', 'BSTM']
        ];

        $courseCounts = [];
        $coursePercentages = [];

        // Check if user is Super Admin
        if (auth()->user()->type === 'admin') {
            // Super Admin - get counts for all departments
            foreach ($departmentCourses as $dept => $courses) {
                $courseCounts[$dept] = [];
                foreach ($courses as $course) {
                    $count = Students::join('surveys', 'students.name', '=', 'surveys.name')
                        ->whereRaw('UPPER(students.course) = ?', [strtoupper($course)])
                        ->distinct('students.id')
                        ->count('students.id');

                    $courseCounts[$dept][$course] = $count;
                }
            }

            // Calculate unfiltered overall statistics
            $userCount = Students::count();
            $response = Survey::latest()->get();

            // Get total employed/unemployed without department filter
            $employed = Students::whereNotNull('employment_status')
                ->where('employment_status', '!=', '')
                ->whereRaw('LOWER(employment_status) != ?', ['unemployed'])
                ->count();

            $notEmployed = Students::where(function ($query) {
                $query->whereNull('employment_status')
                    ->orWhere('employment_status', '')
                    ->orWhereRaw('LOWER(employment_status) = ?', ['unemployed']);
            })
                ->count();

            // Get top 5 positions across all departments
            $positions = Students::whereNotNull('position')
                ->where('position', '!=', '')
                ->selectRaw('position, COUNT(*) as count')
                ->groupBy('position')
                ->orderByDesc('count')
                ->limit(5)
                ->get();
        } else {
            // Existing department-specific logic
            $currentDepartment = strtolower(auth()->user()->name);

            foreach ($departmentCourses as $dept => $courses) {
                $courseCounts[$dept] = [];
                foreach ($courses as $course) {
                    $count = Students::join('surveys', 'students.name', '=', 'surveys.name')
                        ->whereRaw('LOWER(students.department) = ?', [strtolower($dept)])
                        ->whereRaw('UPPER(students.course) = ?', [strtoupper($course)])
                        ->distinct('students.id')
                        ->count('students.id');

                    $courseCounts[$dept][$course] = $count;
                }
            }

            $userCount = Students::where(DB::raw('LOWER(department)'), '=', $currentDepartment)
                ->count();
            $response = Survey::latest()->get();

            $employed = Students::where(DB::raw('LOWER(department)'), '=', $currentDepartment)
                ->whereNotNull('employment_status')
                ->where('employment_status', '!=', '')
                ->whereRaw('LOWER(employment_status) != ?', ['unemployed'])
                ->count();

            $notEmployed = Students::where(DB::raw('LOWER(department)'), '=', $currentDepartment)
                ->where(function ($query) {
                    $query->whereNull('employment_status')
                        ->orWhere('employment_status', '')
                        ->orWhereRaw('LOWER(employment_status) = ?', ['unemployed']);
                })
                ->count();

            $positions = Students::where(DB::raw('LOWER(department)'), '=', $currentDepartment)
                ->whereNotNull('position')
                ->where('position', '!=', '')
                ->selectRaw('position, COUNT(*) as count')
                ->groupBy('position')
                ->orderByDesc('count')
                ->limit(5)
                ->get();
        }

        // Calculate percentages for all departments
        foreach ($courseCounts as $dept => $courses) {
            $total = array_sum($courses);
            $coursePercentages[$dept] = [];
            foreach ($courses as $course => $count) {
                $coursePercentages[$dept][$course] = $total > 0 ?
                    round(($count / $total) * 100) : 0;
            }
        }

        $positionLabels = $positions->pluck('position')->toArray();
        $positionCounts = $positions->pluck('count')->toArray();

        return view('dashboard', compact(
            'userCount',
            'response',
            'coursePercentages',
            'employed',
            'notEmployed',
            'positionLabels',
            'positionCounts'
        ));
    }
}
