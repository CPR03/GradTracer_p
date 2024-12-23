@extends('student.layouts.student-dashboard') @section('title','Edit Profile')
@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    @foreach($users as $student_list) @if($student_list->id == "$student_id")
    <form
        action="/student/profile/update/{{ Auth::guard('student')->user()->id }}"
        method="post"
        class="space-y-5"
    >
        @csrf @method('put')
        <input
            type="hidden"
            name="id"
            value="{{ Auth::guard('student')->user()->id }}"
        />

        <!-- Profile Header -->
        <div
            class="flex items-center justify-between p-6 bg-base-100 rounded-xl shadow-sm border"
        >
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 rounded-full overflow-hidden">
                    <img
                        src="{{ asset('images/default-avatar-icon.jpg') }}"
                        alt="Profile"
                        class="w-full h-full object-cover"
                    />
                </div>
                <div>
                    <h1 class="text-2xl font-bold">
                        {{ $student_list->name }}
                    </h1>
                    <p class="text-gray-500">{{ $student_list->course }}</p>
                </div>
            </div>
            <button type="submit" class="btn btn-primary gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                Save Changes
            </button>
        </div>

        <!-- Basic Info -->
        <div class="card bg-base-100 shadow-sm border">
            <div class="card-body">
                <div class="flex items-center gap-2 mb-6">
                    <i data-lucide="user" class="w-5 h-5 text-primary"></i>
                    <h2 class="card-title">Basic Information</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label"
                            ><span class="label-text">Full Name</span></label
                        >
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $student_list->name) }}"
                            class="input input-bordered w-full"
                            placeholder="Enter Full Name"
                        />
                    </div>

                    <div class="form-control w-full">
                        <label class="label"
                            ><span class="label-text"
                                >Program/Course</span
                            ></label
                        >
                        <input
                            type="text"
                            name="course"
                            value="{{ old('course', $student_list->course) }}"
                            class="input input-bordered w-full"
                            placeholder="Enter Program/Course"
                        />
                    </div>

                    <div class="form-control w-full">
                        <label class="label"
                            ><span class="label-text">Age</span></label
                        >
                        <input
                            type="text"
                            name="age"
                            value="{{ old('age', $student_list->age) }}"
                            class="input input-bordered w-full"
                            placeholder="Enter Age"
                        />
                    </div>

                    <div class="form-control w-full">
                        <label class="label"
                            ><span class="label-text">Email</span></label
                        >
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $student_list->email) }}"
                            class="input input-bordered w-full"
                            placeholder="Enter Email"
                        />
                    </div>

                    <div class="form-control w-full">
                        <label class="label"
                            ><span class="label-text">Birthday</span></label
                        >
                        <input
                            type="date"
                            name="bday"
                            value="{{ old('bday', $student_list->bday) }}"
                            class="input input-bordered w-full"
                        />
                    </div>

                    <div class="form-control w-full">
                        <label class="label"
                            ><span class="label-text">LinkedIn URL</span></label
                        >
                        <input
                            type="text"
                            name="linkedIn"
                            value="{{ old('linkedIn', $student_list->linkedIn) }}"
                            class="input input-bordered w-full"
                            placeholder="Enter LinkedIn URL"
                        />
                    </div>
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
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Employment Status</span>
                        </label>
                        <select
                            name="employment_status"
                            class="select select-bordered w-full"
                        >
                            <option value="" disabled>Select employment status</option>
                            <option value="Employed" {{ old('employment_status', $student_list->employment_status) == 'Employed' ? 'selected' : '' }}>
                                Employed
                            </option>
                            <option value="Unemployed" {{ old('employment_status', $student_list->employment_status) == 'Unemployed' ? 'selected' : '' }}>
                                Unemployed
                            </option>
                        </select>
                    </div>

                    <div class="form-control w-full">
                        <label class="label"
                            ><span class="label-text"
                                >Current Company</span
                            ></label
                        >
                        <input
                            type="text"
                            name="current_company"
                            value="{{ old('current_company', $student_list->current_company) }}"
                            class="input input-bordered w-full"
                            placeholder="Enter Current Company"
                        />
                    </div>

                    <div class="form-control w-full">
                        <label class="label"
                            ><span class="label-text">Position</span></label
                        >
                        <input
                            type="text"
                            name="position"
                            value="{{ old('position', $student_list->position) }}"
                            class="input input-bordered w-full"
                            placeholder="Enter Position"
                        />
                    </div>

                    <div class="form-control w-full">
                        <label class="label"
                            ><span class="label-text"
                                >Employment Duration</span
                            ></label
                        >
                        <input
                            type="date"
                            name="employment_duration"
                            value="{{ old('employment_duration', $student_list->employment_duration) }}"
                            class="input input-bordered w-full"
                        />
                    </div>

                    <div class="form-control w-full md:col-span-2">
                        <label class="label"
                            ><span class="label-text"
                                >Employment Date</span
                            ></label
                        >
                        <input
                            type="date"
                            name="employment_date"
                            value="{{ old('employment_date', $student_list->employment_date) }}"
                            class="input input-bordered w-full"
                        />
                    </div>
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
                    <div class="form-control w-full">
                        <label class="label"
                            ><span class="label-text"
                                >Mobile Number</span
                            ></label
                        >
                        <input
                            type="text"
                            name="contact_number_mobile"
                            value="{{ old('contact_number_mobile', $student_list->contact_number_mobile) }}"
                            class="input input-bordered w-full"
                            placeholder="Enter Mobile Number"
                        />
                    </div>

                    <div class="form-control w-full">
                        <label class="label"
                            ><span class="label-text"
                                >Telephone Number</span
                            ></label
                        >
                        <input
                            type="text"
                            name="contact_number_tel"
                            value="{{ old('contact_number_tel', $student_list->contact_number_tel) }}"
                            class="input input-bordered w-full"
                            placeholder="Enter Telephone Number"
                        />
                    </div>

                    <div class="form-control w-full md:col-span-2">
                        <label class="label"
                            ><span class="label-text"
                                >Current Address</span
                            ></label
                        >
                        <input
                            type="text"
                            name="current_address"
                            value="{{ old('current_address', $student_list->current_address) }}"
                            class="input input-bordered w-full"
                            placeholder="Enter Current Address"
                        />
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif @endforeach
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        lucide.createIcons();
    });
</script>
@endsection
