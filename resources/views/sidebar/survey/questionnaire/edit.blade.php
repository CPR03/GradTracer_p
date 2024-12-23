@extends('layouts.admin-dashboard')
@section('content')

    <style>
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 360px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                <i data-lucide="edit" class="w-6 h-6 text-primary"></i>
                Edit Question
            </h1>
            <a href="/admin/questionnaires/{{ $questionnaire->id }}" class="btn btn-ghost btn-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back
            </a>
        </div>
        <!-- Question Form -->

        <div class="card bg-base-100 shadow-md">
            <div class="card">
                <div class="card-header1">
                    <div class="card-body">
                        <form
                            action="{{ route('admin.questions.update', [
                                'questionnaire' => $questionnaire->id,
                                'section' => $section->id,
                                'question' => $question->id,
                            ]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            @error('answers.*.answer')
                                <span class="text-danger">{{ 'Please complete the choices field' }}</span>
                            @enderror
                            @error('question.*.question_row')
                                <span class="text-danger">{{ 'Please complete the multiple choices field' }}</span>
                            @enderror
                            @error('answers')
                                <div class="alert alert-error">{{ $message }}</div>
                            @enderror
                            <!-- Hidden Fields -->
                            <input type="hidden" name="question[questionnaire_id]" value="{{ $questionnaire->id }}">
                            <input type="hidden" name="question[question_section_id]" value="{{ $sections->id }}">

                            <div class="mb-3">
                                <!-- <label for="question" class="form-label">Enter Section Name: </label>
                                    <input name="question_section[section_name]" value="{{ old('question.section_name') }}" type="text" class="form-control" id="question_section" placeholder="Enter Text here..." size="50">
                                    @error('question.question')
        <span class="text-danger">{{ 'Section Name is Required' }}</span>
    @enderror -->

                                <!-- Question Title -->
                                <div class="form-control w-full mb-6">
                                    <label class="label">
                                        <span class="label-text font-medium">Question Title</span>
                                    </label>
                                    <input type="text" name="questions" value="{{ $question->question }}"
                                        class="input input-bordered w-full @error('question.question') input-error @enderror"
                                        placeholder="Enter your question here">
                                    @error('question.question')
                                        <label class="label">
                                            <span class="label-text-alt text-error">{{ $message }}</span>
                                        </label>
                                    @enderror
                                </div>
                                <!-- Question Type Selection -->
                                <div class="form-control w-full mb-6">
                                    <label class="label">
                                        <span class="label-text font-medium">Question Type</span>
                                    </label>
                                    <select name="question[questionType]" id="questionType"
                                        class="select select-bordered w-full">
                                        <option disabled>Select a question type</option>
                                        <option value="multipleChoice"
                                            {{ $question->questionType == 'radio' ? 'selected' : '' }}>
                                            Multiple Choice (Single Answer)
                                        </option>
                                        <option value="check" {{ $question->questionType == 'check' ? 'selected' : '' }}>
                                            Multiple Choice (Multiple Answers)
                                        </option>
                                        <option value="textBox"
                                            {{ $question->questionType == 'textBox' ? 'selected' : '' }}>
                                            Text Response
                                        </option>
                                        <option value="simple" {{ $question->questionType == 'simple' ? 'selected' : '' }}>
                                            Short Answer
                                        </option>
                                        <option value="date" {{ $question->questionType == 'date' ? 'selected' : '' }}>
                                            Date
                                        </option>
                                        <option value="multipleRadio"
                                            {{ $question->questionType == 'multipleRadio' ? 'selected' : '' }}>
                                            Rating Grid
                                        </option>
                                    </select>
                                </div>

                                <!-- Dynamic Question Options -->
                                <div class="question-options space-y-4">


                                    <!-- Radio Options -->
                                    <div id="radioOptions"
                                        class="{{ $question->questionType == 'multipleChoice' || $question->questionType == 'radio' ? '' : 'hidden' }}">
                                        <div class="card bg-base-100 border">
                                            <div class="card-body">
                                                <h3 class="font-medium mb-4">Multiple Choice Options</h3>
                                                <div id="radioChoices" class="space-y-2">
                                                    @if ($question->questionType == 'multipleChoice' || $question->questionType == 'radio')
                                                        @foreach ($answer as $option)
                                                            <div class="flex items-center gap-2">
                                                                <input type="radio" disabled class="radio radio-primary">
                                                                <input type="text"
                                                                    name="answers[{{ $loop->index }}][answer]"
                                                                    value="{{ old('answers.' . $loop->index . '.answer', $option->answer) }}"
                                                                    class="input input-bordered w-full @error('answers.' . $loop->index . '.answer') input-error @enderror"
                                                                    placeholder="Option {{ $loop->index + 1 }}">
                                                                <input type="hidden"
                                                                    name="answers[{{ $loop->index }}][id]"
                                                                    value="{{ $option->id }}">
                                                                <button type="button"
                                                                    class="btn btn-ghost btn-sm btn-circle"
                                                                    onclick="removeOption(this)">
                                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="mt-4">
                                                    <button type="button" onclick="addRadioOption()"
                                                        class="btn btn-ghost btn-sm">
                                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                                        Add Option
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Checkbox Options -->
                                    <div id="checkboxOptions"
                                        class="{{ $question->questionType == 'check' ? '' : 'hidden' }}">
                                        <div class="card bg-base-100 border">
                                            <div class="card-body">
                                                <h3 class="font-medium mb-4">Checkbox Options</h3>
                                                <div id="checkboxChoices" class="space-y-2">
                                                    @if ($question->questionType == 'check')
                                                        @foreach ($answer as $option)
                                                            <div class="flex items-center gap-2">
                                                                <input type="checkbox" disabled
                                                                    class="checkbox checkbox-primary">
                                                                <input type="text"
                                                                    name="answers[{{ $loop->index }}][answer]"
                                                                    value="{{ old('answers.' . $loop->index . '.answer', $option->answer) }}"
                                                                    class="input input-bordered w-full @error('answers.' . $loop->index . '.answer') input-error @enderror"
                                                                    placeholder="Option {{ $loop->index + 1 }}">
                                                                <input type="hidden"
                                                                    name="answers[{{ $loop->index }}][id]"
                                                                    value="{{ $option->id }}">
                                                                <button type="button"
                                                                    class="btn btn-ghost btn-sm btn-circle"
                                                                    onclick="removeCheckboxOption(this)">
                                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="mt-4">
                                                    <button type="button" onclick="addCheckboxOption()"
                                                        class="btn btn-ghost btn-sm">
                                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                                        Add Option
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Text Response -->
                                    <div id="textResponse"
                                        class="{{ $question->questionType == 'textBox' ? '' : 'hidden' }}">
                                        <div class="card bg-base-100 border">
                                            <div class="card-body">
                                                <h3 class="font-medium mb-4">Long Text Response</h3>
                                                <textarea disabled class="textarea textarea-bordered w-full h-24"
                                                    placeholder="User will enter their response here..."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Short Answer -->
                                    <div id="shortAnswer"
                                        class="{{ $question->questionType == 'simple' ? '' : 'hidden' }}">
                                        <div class="card bg-base-100 border">
                                            <div class="card-body">
                                                <h3 class="font-medium mb-4">Short Answer Response</h3>
                                                <input type="text" disabled class="input input-bordered w-full"
                                                    placeholder="User will enter their response here...">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Date Input -->
                                    <div id="dateInput" class="{{ $question->questionType == 'date' ? '' : 'hidden' }}">
                                        <div class="card bg-base-100 border">
                                            <div class="card-body">
                                                <h3 class="font-medium mb-4">Date Response</h3>
                                                <input type="date" disabled class="input input-bordered w-full">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rating Grid -->
                                    <div id="ratingGrid" class="hidden">
                                        <div class="card bg-base-100 border">
                                            <div class="card-body">
                                                <h3 class="font-medium mb-4">Rating Grid</h3>
                                                <div class="overflow-x-auto">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Criteria</th>
                                                                <th class="text-center">
                                                                    Poorly
                                                                </th>
                                                                <th class="text-center">
                                                                    Fairly
                                                                </th>
                                                                <th class="text-center">
                                                                    Highly
                                                                </th>
                                                                <th class="text-center">
                                                                    Very Highly
                                                                </th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="gridRows"></tbody>
                                                    </table>
                                                </div>
                                                <div class="mt-4">
                                                    <button type="button" onclick="addGridRow()"
                                                        class="btn btn-ghost btn-sm">
                                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                                        Add Row
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- success message display -->
                                @if (session('success'))
                                    <div class="alert alert-success mb-4">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <!-- Submit Button -->
                                <div class="flex justify-end gap-2 mt-6">
                                    <button type="submit" class="btn btn-primary">
                                        <i data-lucide="save" class="w-4 h-4"></i>
                                        Save Changes
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        let originalRadioOptions = [];
        let originalCheckboxOptions = [];
        let radioCounter = {{ count($answer) }};
        let checkboxCounter = {{ count($answer) }};
        let gridCounter = 0;

        // On page load, save the original options based on question type
        document.addEventListener('DOMContentLoaded', function() {
            const currentType = document.getElementById("questionType").value;

            if (currentType === 'multipleChoice') {
                const radioContainer = document.getElementById("radioChoices");
                if (radioContainer) {
                    originalRadioOptions = Array.from(radioContainer.children).map(div => ({
                        answer: div.querySelector('input[type="text"]').value,
                        id: div.querySelector('input[type="hidden"]').value
                    }));
                }
                originalCheckboxOptions = []; // Reset checkbox options
            } else if (currentType === 'check') {
                const checkContainer = document.getElementById("checkboxChoices");
                if (checkContainer) {
                    originalCheckboxOptions = Array.from(checkContainer.children).map(div => ({
                        answer: div.querySelector('input[type="text"]').value,
                        id: div.querySelector('input[type="hidden"]').value
                    }));
                }
                originalRadioOptions = []; // Reset radio options
            }
        });
        // Question type toggle
        document.getElementById("questionType").addEventListener("change", function(e) {
            const options = document.querySelectorAll(".question-options > div");
            options.forEach(opt => opt.classList.add("hidden"));

            const previousType = this.getAttribute('data-previous-type');
            const newType = e.target.value;

            // Clear containers when switching types
            radioCounter = 0;
            checkboxCounter = 0;
            document.getElementById("radioChoices").innerHTML = '';
            document.getElementById("checkboxChoices").innerHTML = '';

            switch (newType) {
                case "multipleChoice":
                    document.getElementById("radioOptions").classList.remove("hidden");
                    if (previousType === 'check') {
                        // Coming from checkbox, reset radio options
                        originalRadioOptions = [];
                        radioCounter = 0;
                    } else if (originalRadioOptions.length > 0) {
                        // Restore original radio options
                        const container = document.getElementById("radioChoices");
                        originalRadioOptions.forEach((option, index) => {
                            const div = document.createElement("div");
                            div.className = "flex items-center gap-2";
                            div.innerHTML = `
                            <input type="radio" disabled class="radio radio-primary">
                            <input type="text"
                                name="answers[${index}][answer]"
                                value="${option.answer}"
                                class="input input-bordered w-full"
                                placeholder="Option ${index + 1}">
                            <input type="hidden" name="answers[${index}][id]" value="${option.id}">
                            <button type="button"
                                class="btn btn-ghost btn-sm btn-circle"
                                onclick="removeOption(this)">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </button>
                        `;
                            container.appendChild(div);
                        });
                        lucide.createIcons();
                        radioCounter = originalRadioOptions.length;
                    }
                    break;

                case "check":
                    document.getElementById("checkboxOptions").classList.remove("hidden");
                    if (previousType === 'multipleChoice') {
                        // Coming from radio, reset checkbox options
                        originalCheckboxOptions = [];
                        checkboxCounter = 0;
                    } else if (originalCheckboxOptions.length > 0) {
                        // Restore original checkbox options
                        const container = document.getElementById("checkboxChoices");
                        originalCheckboxOptions.forEach((option, index) => {
                            const div = document.createElement("div");
                            div.className = "flex items-center gap-2";
                            div.innerHTML = `
                            <input type="checkbox" disabled class="checkbox checkbox-primary">
                            <input type="text"
                                name="answers[${index}][answer]"
                                value="${option.answer}"
                                class="input input-bordered w-full"
                                placeholder="Option ${index + 1}">
                            <input type="hidden" name="answers[${index}][id]" value="${option.id}">
                            <button type="button"
                                class="btn btn-ghost btn-sm btn-circle"
                                onclick="removeCheckboxOption(this)">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </button>
                        `;
                            container.appendChild(div);
                        });
                        lucide.createIcons();
                        checkboxCounter = originalCheckboxOptions.length;
                    }
                    break;

                case "textBox":
                    document.getElementById("textResponse").classList.remove("hidden");
                    break;
                case "simple":
                    document.getElementById("shortAnswer").classList.remove("hidden");
                    break;
                case "date":
                    document.getElementById("dateInput").classList.remove("hidden");
                    break;
            }

            // Save current type for next change
            this.setAttribute('data-previous-type', newType);
        });

        // Add radio option
        function addRadioOption() {
            const container = document.getElementById("radioChoices");
            const div = document.createElement("div");
            div.className = "flex items-center gap-2";
            div.innerHTML = `
            <input type="radio" disabled class="radio radio-primary">
            <input type="text"
                name="answers[${radioCounter}][answer]"
                class="input input-bordered w-full"
                placeholder="Option ${radioCounter + 1}">
            <input type="hidden" name="answers[${radioCounter}][id]" value="">
            <button type="button" class="btn btn-ghost btn-sm btn-circle" onclick="removeOption(this)">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        `;
            container.appendChild(div);
            lucide.createIcons();
            radioCounter++;
        }

        function addRadioOption() {
            const container = document.getElementById("radioChoices");
            const div = document.createElement("div");
            div.className = "flex items-center gap-2";
            div.innerHTML = `
        <input type="radio" disabled class="radio radio-primary">
        <input type="text"
               name="answers[${radioCounter}][answer]"
               class="input input-bordered w-full"
               placeholder="Option ${radioCounter + 1}">
        <button type="button" class="btn btn-ghost btn-sm btn-circle" onclick="removeOption(this)">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    `;
            container.appendChild(div);
            lucide.createIcons();
            radioCounter++;
        }

        function addCheckDupOption() {
            const container = document.getElementById("checkDupChoices");
            const div = document.createElement("div");
            div.className = "flex items-center gap-2";
            div.innerHTML = `
        <input type="checkbox" disabled class="checkbox checkbox-primary">
        <input type="text"
               name="answers[${checkDupCounter}][answer]"
               class="input input-bordered w-full"
               placeholder="Option ${checkDupCounter + 1}">
        <button type="button" class="btn btn-ghost btn-sm btn-circle" onclick="removeOption(this)">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    `;
            container.appendChild(div);
            lucide.createIcons();
            checkDupCounter++;
        }

        // Add checkbox option
        function addCheckboxOption() {
            const container = document.getElementById("checkboxChoices");
            const div = document.createElement("div");
            div.className = "flex items-center gap-2";
            div.innerHTML = `
            <input type="checkbox" disabled class="checkbox checkbox-primary">
            <input type="text"
                name="answers[${checkboxCounter}][answer]"
                class="input input-bordered w-full"
                placeholder="Option ${checkboxCounter + 1}">
            <input type="hidden" name="answers[${checkboxCounter}][id]" value="">
            <button type="button" class="btn btn-ghost btn-sm btn-circle" onclick="removeCheckboxOption(this)">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        `;
            container.appendChild(div);
            lucide.createIcons();
            checkboxCounter++;
        }

        function removeCheckboxOption(element) {
            const parentDiv = element.closest('div');
            if (parentDiv) {
                parentDiv.remove();
                reindexCheckboxOptions();
            }
        }

        function reindexCheckboxOptions() {
            const container = document.getElementById("checkboxChoices");
            const options = container.getElementsByClassName("flex");
            Array.from(options).forEach((option, index) => {
                const input = option.querySelector('input[type="text"]');
                const hiddenInput = option.querySelector('input[type="hidden"]');
                if (input) {
                    input.name = `answers[${index}][answer]`;
                    input.placeholder = `Option ${index + 1}`;
                }
                if (hiddenInput) {
                    hiddenInput.name = `answers[${index}][id]`;
                }
            });
        }

        // Add grid row
        function addGridRow() {
            const container = document.getElementById("gridRows");
            const tr = document.createElement("tr");
            tr.innerHTML = `
        <td>
            <input type="text"
                   name="question_row[${gridCounter}][question_row]"
                   class="input input-bordered w-full"
                   placeholder="Enter criteria">
        </td>
        <td class="text-center"><input type="radio" disabled class="radio radio-primary"></td>
        <td class="text-center"><input type="radio" disabled class="radio radio-primary"></td>
        <td class="text-center"><input type="radio" disabled class="radio radio-primary"></td>
        <td class="text-center"><input type="radio" disabled class="radio radio-primary"></td>
        <td>
            <button type="button" class="btn btn-ghost btn-sm btn-circle" onclick="removeOption(this.closest('tr'))">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </td>
    `;
            container.appendChild(tr);
            lucide.createIcons();
            gridCounter++;
        }

        function removeOption(element) {
            const parentDiv = element.closest('div');
            if (parentDiv) {
                parentDiv.remove();
                // Reindex remaining options
                reindexOptions();
            }
        }

        function reindexOptions() {
            const container = document.getElementById("radioChoices");
            const options = container.getElementsByClassName("flex");
            Array.from(options).forEach((option, index) => {
                const input = option.querySelector('input[type="text"]');
                const hiddenInput = option.querySelector('input[type="hidden"]');
                if (input) {
                    input.name = `answers[${index}][answer]`;
                    input.placeholder = `Option ${index + 1}`;
                }
                if (hiddenInput) {
                    hiddenInput.name = `answers[${index}][id]`;
                }
            });
        }
        // Update question type change handler
        function updateQuestionType(select) {
            const type = select.value;
            document.getElementById('radioOptions').classList.toggle('hidden', type !== 'multipleChoice');
            document.getElementById('checkboxOptions').classList.toggle('hidden', type !== 'check');
        }
    </script>







@endsection
