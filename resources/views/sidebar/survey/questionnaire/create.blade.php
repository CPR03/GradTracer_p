@extends('layouts.admin-dashboard')
@section('content')
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                <i data-lucide="clipboard-plus" class="w-6 h-6 text-primary"></i>
                Create New Questionnaire
            </h1>
            <a href="{{ url()->previous() }}" class="btn btn-ghost btn-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back
            </a>
        </div>

        <!-- Form Card -->
        <div class="card bg-base-100 shadow-md">
            <div class="card-body">
                <form action="/admin/questionnaires" method="post">
                    @csrf

                    <!-- Title Field -->
                    <div class="form-control w-full mb-4">
                        <label class="label">
                            <span class="label-text font-medium">Questionnaire Title</span>
                        </label>
                        <input type="text" name="title" value="{{ old('question.question') }}"
                            class="input input-bordered w-full @error('title') input-error @enderror"
                            placeholder="Enter questionnaire title">
                        <label class="label">
                            <span class="label-text-alt text-gray-600">Give your questionnaire a descriptive title</span>
                            @error('title')
                                <span class="label-text-alt text-error">{{ 'Please complete the title field' }}</span>
                            @enderror
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-primary">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            Create Questionnaire
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
