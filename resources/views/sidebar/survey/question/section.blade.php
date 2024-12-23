@extends('layouts.admin-dashboard')
@section('content')

<div class="container mx-auto px-4">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
            <i data-lucide="layout" class="w-6 h-6 text-primary"></i>
            Create New Section
        </h1>
        <a href="{{ url()->previous() }}" class="btn btn-ghost btn-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back
        </a>
    </div>

    <!-- Form Card -->
    <div class="card bg-base-100 shadow-md">
        <div class="card-body">
            <form action="/admin/questionnaires/{{ $questionnaire->id }}/sections" method="post">
                @csrf

                <!-- Section Name Field -->
                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text font-medium">Section Name</span>
                    </label>
                    <input
                        type="text"
                        name="section_name"
                        value="{{ old('section_name.section_name') }}"
                        class="input input-bordered w-full @error('section_name') input-error @enderror"
                        placeholder="Enter section name"
                        required
                    >
                    <label class="label">
                        <span class="label-text-alt text-gray-600">Give your section a descriptive name</span>
                        @error('section_name')
                            <span class="label-text-alt text-error">{{ 'Please complete this field' }}</span>
                        @enderror
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        Create Section
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
