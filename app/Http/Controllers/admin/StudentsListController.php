<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Students;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StudentsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:User access|User create|User edit|User delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:User create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:User edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:User delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = auth()->user();

        // Check if user is admin
        if ($user->type === 'admin') {
            // For admin, get all students with search functionality
            $query = Students::query();

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('department', 'like', "%{$search}%");
                });
            }

            $students = $query->get();
            return view('sidebar.students.index', compact('students'));
        }

        // For department users, keep existing department-specific logic
        $ccmsQuery = Students::where('department', 'CCMS');
        $cengQuery = Students::where('department', 'CENG');
        $cbaQuery = Students::where('department', 'CBA');

        if ($search) {
            $searchWhere = function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%");
            };

            $ccmsQuery->where($searchWhere);
            $cengQuery->where($searchWhere);
            $cbaQuery->where($searchWhere);
        }

        $ccms = $ccmsQuery->get();
        $ceng = $cengQuery->get();
        $cba = $cbaQuery->get();

        return view('sidebar.students.index', compact('ccms', 'ceng', 'cba'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('sidebar.departments.new', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        $user = Students::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->syncRoles($request->roles);
        return redirect('/admin/departments');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Students $student_list)
    {
        $role = Role::get();
        $student_list->roles;
        return view('sidebar.students.edit', ['student_list' => $student_list, 'roles' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Students $student_list)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $student_list->id . ',id',
            'approved' => 'nullable',
        ]);

        if ($request->password != null) {
            $request->validate([
                'password' => 'required|confirmed'
            ]);
            $validated['password'] = bcrypt($request->password);
        }

        $student_list->update($validated);

        $student_list->syncRoles($request->roles);
        return redirect('/admin/student_lists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Students $student_list)
    {
        $student_list->delete();
        return redirect()->back()->withSuccess('Role deleted !!!');
    }
}
