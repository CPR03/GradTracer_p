@extends('layouts.admin-dashboard')
@section('content')
    <div class="w-full max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col gap-4 mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ url()->previous() }}" class="btn btn-ghost btn-circle">
                        <i data-lucide="arrow-left" class="w-6 h-6"></i>
                    </a>
                    <i data-lucide="clipboard-list" class="w-8 h-8 text-primary"></i>
                    <h1 class="text-2xl font-bold text-gray-800">
                        {{ $questionnaire->title }} - Survey Results
                    </h1>
                </div>

                <a href="{{ route('admin.questionnaires.export', $questionnaire->id) }}"
                    class="btn btn-success gap-2 text-white">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    Export to Excel
                </a>
            </div>

            <!-- Statistics Overview -->
            <div class="stats stats-vertical lg:stats-horizontal shadow">
                <div class="stat">
                    <div class="stat-title">Total Responses</div>
                    <div class="stat-value">{{ $totalResponses }}</div>
                </div>

                <div class="stat">
                    <div class="stat-title">Completion Rate</div>
                    <div class="stat-value">{{ number_format($completionRate, 1) }}%</div>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-lg mb-8">
            <div class="card-body">
                <div class="flex flex-col lg:flex-row gap-4">
                    <!-- Search -->
                    <div class="form-control flex-1">
                        <div class="input-group w-full flex items-center gap-2">
                            <input type="text" id="searchInput" placeholder="Search respondents..."
                                class="input input-bordered flex-1" />
                            <!-- <button class="btn btn-square btn-primary">
                                            <i data-lucide="search" class="w-5 h-5"></i>
                                        </button> -->
                        </div>
                    </div>

                    <!-- Section Filter -->
                    <div class="form-control max-w-xs">
                        <select id="sectionFilter" class="select select-bordered w-full">
                            <option value="">All Sections</option>
                            @foreach ($sections->sections as $section)
                                <option value="{{ $section->section_name }}">
                                    {{ $section->section_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date Range -->
                    <div class="flex gap-2">
                        <div class="form-control">
                            <input type="date" id="dateFrom" class="input input-bordered" />
                        </div>
                        <div class="form-control">
                            <input type="date" id="dateTo" class="input input-bordered" />
                        </div>
                    </div>

                    <!-- Sort -->
                    <div class="form-control max-w-xs">
                        <select id="sortBy" class="select select-bordered">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="name">Name A-Z</option>
                            <option value="name-desc">Name Z-A</option>
                        </select>
                    </div>

                    <!-- Reset -->
                    <button onclick="resetFilters()" class="btn btn-ghost gap-2">
                        <i data-lucide="refresh-ccw" class="w-4 h-4"></i>
                        Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- Survey Responses -->
        <div class="card bg-base-100 shadow-lg">
            <div class="card-body">
                <table id="responseTable" class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th>Respondent</th>
                            <th>Section/Question</th>
                            <th>Response</th>
                            <th>Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections->sections as $section)
                            <!-- Section Header -->
                            <tr class="bg-base-200">
                                <td colspan="4" class="font-medium">
                                    {{ $section->section_name }}
                                </td>
                            </tr>

                            @foreach ($section->questions as $question)
                                @foreach ($surveys->surveys as $survey)
                                    @foreach ($survey->responses as $response)
                                        @if ($response->question_id == $question->id)
                                            <tr>
                                                <td>{{ $survey->name }}</td>
                                                <td>{{ $question->question }}</td>
                                                <td>
                                                    @switch($question->questionType)
                                                        @case('multipleChoice')
                                                        @case('check')
                                                            {{ $response->answer_name }}
                                                        @break

                                                        @case('textBox')
                                                        @case('simple')
                                                            <div class="whitespace-pre-wrap">
                                                                {{ $response->answer_name }}
                                                            </div>
                                                        @break

                                                        @case('date')
                                                            {{ \Carbon\Carbon::parse($response->answer_name)->format('M d, Y') }}
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>{{ $survey->created_at->format('M d, Y g:i A') }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Evaluation Results -->
        @if ($evaluations->table_evaluation->isNotEmpty())
            <div class="card bg-base-100 shadow-lg mt-8">
                <div class="card-body">
                    <h3 class="card-title text-lg font-semibold mb-4">
                        <i data-lucide="bar-chart" class="w-5 h-5 text-primary"></i>
                        Rating Grid Results
                    </h3>

                    @foreach ($evaluations->table_evaluation as $evaluation)
                        <div class="mb-8">
                            <h4 class="font-medium mb-4">{{ $evaluation->question }}</h4>
                            <div class="overflow-x-auto">
                                <table class="table table-zebra w-full">
                                    <thead>
                                        <tr>
                                            <th>Criteria</th>
                                            <th class="text-center">Poor (1)</th>
                                            <th class="text-center">Fair (2)</th>
                                            <th class="text-center">Good (3)</th>
                                            <th class="text-center">Excellent (4)</th>
                                            <th class="text-center">Average</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($evaluation->multiple_questions as $question)
                                            <tr>
                                                <td>{{ $question->question_row }}</td>
                                                @php
                                                    // Get all evaluation responses for this question
                                                    $ratings = \App\Models\EvaluationResponse::where(
                                                        'multiple_question_id',
                                                        $question->id,
                                                    )->get();

                                                    $total = $ratings->count();

                                                    // Calculate average
                                                    $avg = $total > 0 ? $ratings->avg('answer_name') : 0;
                                                @endphp

                                                @for ($i = 1; $i <= 4; $i++)
                                                    <td class="text-center">
                                                        @php
                                                            $ratingCount = $ratings
                                                                ->where('answer_name', (string) $i)
                                                                ->count();
                                                            $percentage =
                                                                $total > 0 ? ($ratingCount / $total) * 100 : 0;
                                                        @endphp
                                                        {{ $ratingCount }}
                                                        ({{ number_format($percentage, 1) }}%)
                                                    </td>
                                                @endfor

                                                <td class="text-center font-medium">
                                                    {{ number_format($avg, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const sectionFilter = document.getElementById('sectionFilter');
            const dateFrom = document.getElementById('dateFrom');
            const dateTo = document.getElementById('dateTo');
            const sortBy = document.getElementById('sortBy');
            const table = document.getElementById('responseTable');
            const rows = table.getElementsByTagName('tr');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedSection = sectionFilter.value;
                const fromDate = dateFrom.value ? new Date(dateFrom.value) : null;
                const toDate = dateTo.value ? new Date(dateTo.value) : null;

                let currentSection = '';

                Array.from(rows).forEach(row => {
                    if (row.classList.contains('bg-base-200')) {
                        currentSection = row.cells[0].textContent.trim();
                        row.style.display = selectedSection && selectedSection !== currentSection ? 'none' :
                            '';
                        return;
                    }

                    if (!row.classList.contains('bg-base-200') && row.cells.length > 1) {
                        const name = row.cells[0].textContent.toLowerCase();
                        const date = new Date(row.cells[3].textContent);

                        const matchesSearch = name.includes(searchTerm);
                        const matchesSection = !selectedSection || currentSection === selectedSection;
                        const matchesDate = (!fromDate || date >= fromDate) &&
                            (!toDate || date <= toDate);

                        row.style.display = matchesSearch && matchesSection && matchesDate ? '' : 'none';
                    }
                });
            }

            function sortTable() {
                const tbody = table.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr:not(.bg-base-200)'));

                rows.sort((a, b) => {
                    const aVal = a.cells[sortBy.value === 'name' || sortBy.value === 'name-desc' ? 0 : 3]
                        .textContent;
                    const bVal = b.cells[sortBy.value === 'name' || sortBy.value === 'name-desc' ? 0 : 3]
                        .textContent;

                    if (sortBy.value === 'newest') return new Date(bVal) - new Date(aVal);
                    if (sortBy.value === 'oldest') return new Date(aVal) - new Date(bVal);
                    if (sortBy.value === 'name') return aVal.localeCompare(bVal);
                    if (sortBy.value === 'name-desc') return bVal.localeCompare(aVal);
                });

                rows.forEach(row => tbody.appendChild(row));
            }

            searchInput.addEventListener('input', filterTable);
            sectionFilter.addEventListener('change', filterTable);
            dateFrom.addEventListener('change', filterTable);
            dateTo.addEventListener('change', filterTable);
            sortBy.addEventListener('change', sortTable);

            window.resetFilters = function() {
                searchInput.value = '';
                sectionFilter.value = '';
                dateFrom.value = '';
                dateTo.value = '';
                sortBy.value = 'newest';
                filterTable();
                sortTable();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
