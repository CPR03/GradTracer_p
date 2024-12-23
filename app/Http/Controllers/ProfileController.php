<?php

namespace App\Http\Controllers;
use App\Models\Students;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProfileController extends Controller
{
    public function index(Students $student_id)
    {
        $posts = Post::latest()->get();
        $users = Students::latest()->get();
        $student_id = $student_id->id;
        return view('student.profile.index',['users'=>$users, 'student_id'=>$student_id]);
    }

    public function edit(Students $student_id)
    {
        $users = Students::latest()->get();
        $student_id = $student_id->id;
       return view('student.profile.edit',['users'=>$users, 'student_id'=>$student_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Students $student_id)
    {
        $test = DB::table('students')->where('id', $request->id)->update([
            'name'=>$request->input('name'),
            'age'=>$request->input('age'),
            'bday'=>$request->input('bday'),
            'linkedIn'=>$request->input('linkedIn'),
            'employment_status'=>$request->input('employment_status'),
            'current_company'=>$request->input('current_company'),
            'position'=>$request->input('position'),
            'employment_duration'=>$request->input('employment_duration'),
            'employment_date'=>$request->input('employment_date'),
            'contact_number_mobile'=>$request->input('contact_number_mobile'),
            'contact_number_tel'=>$request->input('contact_number_tel'),
            'current_address'=>$request->input('current_address')
        ]);
        // return($test);
        // $validated = $request->validate([
        //     'name'=>'nullable',
        //     'age'=>'nullable',
        //     'bday'=>'nullable',
        //     'linkedIn'=>'nullable',
        //     'employment_status'=>'nullable',
        //     'current_company'=>'nullable',
        //     'position'=>'nullable',
        //     'employment_duration'=>'nullable',
        //     'employment_date'=>'nullable',
        //     'contact_number_mobile'=>'nullable',
        //     'contact_number_tel'=>'nullable',
        //     'current_address'=>'nullable'
        // ]);

        // foreach($student_id as $key => $no){
        //     $test = Students::find($student_id);
        //     $test->update()([
        //         'name'=>'nullable',
        //     'age'=>'nullable',
        //     'bday'=>'nullable',
        //     'linkedIn'=>'nullable',
        //     'employment_status'=>'nullable',
        //     'current_company'=>'nullable',
        //     'position'=>'nullable',
        //     'employment_duration'=>'nullable',
        //     'employment_date'=>'nullable',
        //     'contact_number_mobile'=>'nullable',
        //     'contact_number_tel'=>'nullable',
        //     'current_address'=>'nullable'
        //     ]);
        // }

        return redirect("/student/profile/{$request->id}")->with('success', 'Profile updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
