{{-- register.blade.php --}}
@extends('layouts.auth-layout')

@section('title', 'Student Registration')
@section('form-title', 'Create Account')
@section('form-subtitle', 'Join our graduate community')

@section('form-content')
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <!-- Name Input -->
        <div class="form-control">
            <label class="label">
                <span class="label-text flex items-center gap-2">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    Full Name
                </span>
            </label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="input input-bordered w-full focus:input-primary @error('name') input-error @enderror"
                placeholder="Juan Dela Cruz" required minlength="2" maxlength="255" autofocus />
            @error('name')
                <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
            @enderror
        </div>

        <!-- Department Select -->
        <div class="form-control">
            <label class="label">
                <span class="label-text flex items-center gap-2">
                    <i data-lucide="building" class="w-4 h-4"></i>
                    Department
                </span>
            </label>
            <select name="department"
                class="select select-bordered w-full focus:select-primary @error('department') select-error @enderror"
                required>
                <option value="">Choose Department</option>
                <option value="ccms" {{ old('department') == 'ccms' ? 'selected' : '' }}>CCMS</option>
                <option value="ceng" {{ old('department') == 'ceng' ? 'selected' : '' }}>CENG</option>
                <option value="cba" {{ old('department') == 'cba' ? 'selected' : '' }}>CBA</option>
                <option value="cas" {{ old('department') == 'cas' ? 'selected' : '' }}>CAS</option>
                <option value="cnahs" {{ old('department') == 'cnahs' ? 'selected' : '' }}>CNAHS</option>
            </select>
            @error('department')
                <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
            @enderror
        </div>

        <!-- Course Input -->
        <div class="form-control">
            <label class="label">
                <span class="label-text flex items-center gap-2">
                    <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                    Course
                </span>
            </label>
            <select name="course" id="courseSelect"
                class="select select-bordered w-full focus:select-primary @error('course') select-error @enderror" required
                disabled>
                <option value="">Select Department First</option>
            </select>
            @error('course')
                <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
            @enderror
        </div>

        <!-- Email Input -->
        <div class="form-control">
            <label class="label">
                <span class="label-text flex items-center gap-2">
                    <i data-lucide="mail" class="w-4 h-4"></i>
                    Email
                </span>
            </label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="input input-bordered w-full focus:input-primary @error('email') input-error @enderror"
                placeholder="juan.delacruz@example.com" required />
            @error('email')
                <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
            @enderror
        </div>

        <!-- Password Input -->
        <div class="form-control">
            <label class="label">
                <span class="label-text flex items-center gap-2">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                    Password
                </span>
            </label>
            <input type="password" name="password"
                class="input input-bordered w-full focus:input-primary @error('password') input-error @enderror"
                placeholder="Create a strong password" required minlength="8" />
            @error('password')
                <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-control">
            <label class="label">
                <span class="label-text flex items-center gap-2">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                    Confirm Password
                </span>
            </label>
            <input type="password" name="password_confirmation" class="input input-bordered w-full focus:input-primary"
                placeholder="Confirm your password" required minlength="8" />
        </div>

        <!-- Terms Agreement -->
        <!-- <div class="form-control">
            <label class="label cursor-pointer justify-start gap-2">
                <input type="checkbox" name="agree-term"
                    class="checkbox checkbox-sm checkbox-primary @error('agree-term') @enderror" required />
                <span class="label-text">
                    I agree to the
                    <a href="#" class="link link-primary">Terms of Service</a>
                </span>
            </label>
            @error('agree-term')
                <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
            @enderror
        </div> -->

        <!-- Submit Button -->
        <button type="submit"
            class="btn signInButton  text-white w-full gap-2 hover:shadow-lg transition-all duration-300">
            <i data-lucide="user-plus" class="w-4 h-4"></i>
            Create Account
        </button>

        <!-- Login Link -->
        <div class="text-center text-sm">
            Already have an account?
            <a href="{{ route('login') }}" class="link link-primary">Sign in</a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departmentCourses = {
                'ccms': ['BSIT', 'BSIS', 'BSCS', 'BSEMC'],
                'ceng': ['BSEE', 'BSCPE', 'BSIE', 'BSGD'],
                'cba': ['BSBA', 'BSA', 'BSMA', 'BSTM']
            };

            const departmentSelect = document.querySelector('select[name="department"]');
            const courseSelect = document.querySelector('select[name="course"]');
            const oldCourse = "{{ old('course') }}";

            function updateCourseOptions(selectedDept) {
                courseSelect.innerHTML = '';

                if (!selectedDept) {
                    courseSelect.innerHTML = '<option value="">Select Department First</option>';
                    courseSelect.disabled = true;
                    return;
                }

                const courses = departmentCourses[selectedDept] || [];

                if (courses.length) {
                    courseSelect.disabled = false;
                    courseSelect.innerHTML = '<option value="">Select Course</option>';
                    courses.forEach(course => {
                        const option = document.createElement('option');
                        option.value = course;
                        option.textContent = course;
                        if (oldCourse === course) {
                            option.selected = true;
                        }
                        courseSelect.appendChild(option);
                    });
                } else {
                    courseSelect.innerHTML = '<option value="">No courses available</option>';
                    courseSelect.disabled = true;
                }
            }

            // Initial load if department is pre-selected
            if (departmentSelect.value) {
                updateCourseOptions(departmentSelect.value.toLowerCase());
            }

            // On department change
            departmentSelect.addEventListener('change', function() {
                const selectedDept = this.value.toLowerCase();
                updateCourseOptions(selectedDept);
            });
        });
    </script>
@endsection
