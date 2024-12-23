@extends('layouts.admin-dashboard')
@section('content')

<div class="container mx-auto px-4">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
            <i data-lucide="user-cog" class="w-6 h-6 text-primary"></i>
            Edit Student User
        </h1>
        <a href="{{ route('admin.student_lists.index') }}" class="btn btn-ghost btn-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back to List
        </a>
    </div>

    <!-- Form Card -->
    <div class="card bg-base-100 shadow-md">
        <div class="card-body">
            <form action="{{ route('admin.student_lists.update', $student_list->id)}}" method="post">
                @csrf
                @method('put')

                <!-- Name Field -->
                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text font-medium">Full Name</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $student_list->name) }}"
                        class="input input-bordered w-full @error('name') input-error @enderror"
                        placeholder="Enter student's full name"
                    >
                    @error('name')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text font-medium">Email Address</span>
                    </label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $student_list->email) }}"
                        class="input input-bordered w-full @error('email') input-error @enderror"
                        placeholder="Enter email address"
                    >
                    @error('email')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Course Field -->
                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text font-medium">Course</span>
                    </label>
                    <input
                        type="text"
                        name="course"
                        value="{{ old('course', $student_list->course) }}"
                        class="input input-bordered w-full @error('course') input-error @enderror"
                        placeholder="Enter course"
                    >
                    @error('course')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Department Field -->
                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text font-medium">Department</span>
                    </label>
                    <input
                        type="text"
                        name="department"
                        value="{{ old('department', $student_list->department) }}"
                        class="input input-bordered w-full @error('department') input-error @enderror"
                        placeholder="Enter department"
                    >
                    @error('department')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Approval Checkbox -->
                <div class="form-control w-full mb-6">
                    <label class="label cursor-pointer justify-start gap-3">
                        <input
                            type="checkbox"
                            name="approved"
                            value="1"
                            class="checkbox checkbox-primary"
                            {{ $student_list->approved ? 'checked' : '' }}
                        >
                        <span class="label-text">Approve this student</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Update Student
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
