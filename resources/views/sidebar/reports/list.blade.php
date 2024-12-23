@extends('layouts.admin-dashboard')
@section('content')
    <div class="w-full max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="flex items-center gap-3 mb-6">
            <i data-lucide="file-spreadsheet" class="w-8 h-8 text-primary"></i>
            <h1 class="text-2xl font-bold text-gray-800">Survey Reports</h1>
        </div>

        <!-- Reports Grid -->
        <div class="grid gap-4">
            @foreach ($questionnaires as $key => $questionnaire)
                <div class="card bg-base-100 hover:shadow-lg transition-shadow duration-300 border border-gray-200">
                    <div class="card-body flex flex-row items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="bg-primary/10 p-3 rounded-lg">
                                <i data-lucide="clipboard-list" class="w-6 h-6 text-primary"></i>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Report #{{ $key + 1 }}</span>
                                <h2 class="text-lg font-semibold text-gray-800">{{ $questionnaire->title }}</h2>
                            </div>
                        </div>

                        <a href="{{ $questionnaire->result_path() }}" class="btn btn-primary gap-2">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                            View Report
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($questionnaires->isEmpty())
            <div class="text-center py-12">
                <i data-lucide="clipboard-x" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900">No Reports Available</h3>
                <p class="text-gray-500 mt-2">There are no survey reports to display at this time.</p>
            </div>
        @endif
    </div>
@endsection
