<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Students;
use App\Models\Department;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'type' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        $department = User::create([
            'name'=>'department',
            'type' => 'department',
            'email'=>'department@department.com',
            'password'=>bcrypt('department')
        ]);

        $department_ccms = User::create([
            'name'=>'ccms',
            'type' => 'department',
            'email'=>'ccms@ccms.com',
            'password'=>bcrypt('ccms')
        ]);

        $department_ceng = User::create([
            'name'=>'ceng',
            'type' => 'department',
            'email'=>'ceng@ceng.com',
            'password'=>bcrypt('ceng')
        ]);

        $department_cba = User::create([
            'name'=>'cba',
            'type' => 'department',
            'email'=>'cba@cba.com',
            'password'=>bcrypt('cba')
        ]);

        $alumni = User::create([
            'name'=>'alumni',
            'type' => 'alumni',
            'email'=>'alumni@alumni.com',
            'password'=>bcrypt('alumni')
        ]);

        $student = Students::create([
            'name'=>'student',
            'answered'=>'0',
            'department'=>'department',
            'course'=>'student',
            'email'=>'student@student.com',
            'password'=>bcrypt('student')
        ]);

        $ccms = Students::create([
            'name'=>'ccms',
            'answered'=>'0',
            'department'=>'ccms',
            'course'=>'bsit',
            'approved'=>'1',
            'email'=>'ccms@ccms.com',
            'password'=>bcrypt('ccms')
        ]);

        $ccms1 = Students::create([
            'name'=>'ccms1',
            'answered'=>'0',
            'department'=>'ccms1',
            'course'=>'bsis',
            'approved'=>'1',
            'email'=>'ccms1@ccms.com',
            'password'=>bcrypt('ccms1')
        ]);

        $ceng = Students::create([
            'name'=>'ceng',
            'answered'=>'0',
            'department'=>'ceng',
            'course'=>'BSEE',
            'email'=>'ceng@ceng.com',
            'password'=>bcrypt('ceng')
        ]);

        $ceng = Students::create([
            'name'=>'cba',
            'answered'=>'0',
            'department'=>'cba',
            'course'=>'BSBA',
            'email'=>'cba@cba.com',
            'password'=>bcrypt('cba')
        ]);




        $admin_role = Role::create(['name' => 'admin']);
        $department_role = Role::create(['name' => 'department']);
        $alumni_role = Role::create(['name' => 'alumni']);
        $student_role = Role::create(['name' => 'student' , 'guard_name'  => 'student']);


         $permission = Permission::create(['name' => 'Post access']);
         $permission = Permission::create(['name' => 'Post edit']);
         $permission = Permission::create(['name' => 'Post create']);
         $permission = Permission::create(['name' => 'Post delete']);

        $permission = Permission::create(['name' => 'Department access']);
        $permission = Permission::create(['name' => 'Department edit']);
        $permission = Permission::create(['name' => 'Department create']);
        $permission = Permission::create(['name' => 'Department delete']);

        $permission = Permission::create(['name' => 'Result access']);
        $permission = Permission::create(['name' => 'Result edit']);
        $permission = Permission::create(['name' => 'Result create']);
        $permission = Permission::create(['name' => 'Result delete']);

        $permission = Permission::create(['name' => 'Role access']);
        $permission = Permission::create(['name' => 'Role edit']);
        $permission = Permission::create(['name' => 'Role create']);
        $permission = Permission::create(['name' => 'Role delete']);

        $permission = Permission::create(['name' => 'User access']);
        $permission = Permission::create(['name' => 'User edit']);
        $permission = Permission::create(['name' => 'User create']);
        $permission = Permission::create(['name' => 'User delete']);

        $permission = Permission::create(['name' => 'Permission access']);
        $permission = Permission::create(['name' => 'Permission edit']);
        $permission = Permission::create(['name' => 'Permission create']);
        $permission = Permission::create(['name' => 'Permission delete']);

        $permission = Permission::create(['name' => 'Survey access']);
        $permission = Permission::create(['name' => 'Survey edit']);
        $permission = Permission::create(['name' => 'Survey create']);
        $permission = Permission::create(['name' => 'Survey delete']);

        $admin->assignRole($admin_role);
        $department->assignRole($department_role);
        $department_ccms->assignRole($department_role);
        $department_ceng->assignRole($department_role);
        $department_cba->assignRole($department_role);
        $alumni->assignRole($alumni_role);
        $student->assignRole($student_role);

        $admin_role->givePermissionTo(Permission::all());
        $department_role->givePermissionTo(Permission::all());
        $alumni_role->givePermissionTo(Permission::all());
    }
}
