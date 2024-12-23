@extends('student.layouts.student-dashboard')
@section('title','Student Profile')
@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    @foreach ($users as $student_list)
    @if ($student_list->id == "$student_id")

    <!-- Profile Header -->
    <div class="flex items-center justify-between p-6 bg-base-100 rounded-xl shadow-sm border">
        <div class="flex items-center gap-4">
            <div class="w-20 h-20 rounded-full overflow-hidden">
                <img src="{{ asset('images/default-avatar-icon.jpg') }}" alt="Profile" class="w-full h-full object-cover">
            </div>
            <div>
                <h1 class="text-2xl font-bold">{{ $student_list->name }}</h1>
                <p class="text-gray-500">{{ $student_list->course }}</p>
            </div>
        </div>
        <a href="/student/profile/edit/{{ Auth::guard('student')->user()->id }}"
           class="btn btn-primary gap-2">
            <i data-lucide="pencil" class="w-4 h-4"></i>
            Edit Profile
        </a>
    </div>

    <!-- Basic Info -->
    <div class="card bg-base-100 shadow-sm border">
        <div class="card-body">
            <div class="flex items-center gap-2 mb-6">
                <i data-lucide="user" class="w-5 h-5 text-primary"></i>
                <h2 class="card-title">Basic Information</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <dl class="space-y-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                        <dd class="mt-1">{{ $student_list->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Age</dt>
                        <dd class="mt-1">{{ $student_list->age }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Birthday</dt>
                        <dd class="mt-1">{{ $student_list->bday }}</dd>
                    </div>
                </dl>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Program/Course</dt>
                        <dd class="mt-1">{{ $student_list->course }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1">{{ $student_list->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">LinkedIn</dt>
                        <dd class="mt-1">
                            @if($student_list->linkedIn)
                                <a href="{{ $student_list->linkedIn }}" target="_blank" class="text-primary hover:underline">View Profile</a>
                            @else
                                Not provided
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Employment Info -->
    <div class="card bg-base-100 shadow-sm border">
        <div class="card-body">
            <div class="flex items-center gap-2 mb-6">
                <i data-lucide="briefcase" class="w-5 h-5 text-primary"></i>
                <h2 class="card-title">Employment Information</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <dl class="space-y-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Employment Status</dt>
                        <dd class="mt-1">{{ $student_list->employment_status ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Position</dt>
                        <dd class="mt-1">{{ $student_list->position ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Employment Duration</dt>
                        <dd class="mt-1">{{ $student_list->employment_duration ?: 'Not specified' }}</dd>
                    </div>
                </dl>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Current Company</dt>
                        <dd class="mt-1">{{ $student_list->current_company ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Employment Date</dt>
                        <dd class="mt-1">{{ $student_list->employment_date ?: 'Not specified' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Contact Info -->
    <div class="card bg-base-100 shadow-sm border">
        <div class="card-body">
            <div class="flex items-center gap-2 mb-6">
                <i data-lucide="phone" class="w-5 h-5 text-primary"></i>
                <h2 class="card-title">Contact Information</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <dl class="space-y-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Mobile Number</dt>
                        <dd class="mt-1">{{ $student_list->contact_number_mobile ?: 'Not provided' }}</dd>
                    </div>
                </dl>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Telephone Number</dt>
                        <dd class="mt-1">{{ $student_list->contact_number_tel ?: 'Not provided' }}</dd>
                    </div>
                </dl>
                <dl class="space-y-2 md:col-span-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Current Address</dt>
                        <dd class="mt-1">{{ $student_list->current_address ?: 'Not provided' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    @endif
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection
