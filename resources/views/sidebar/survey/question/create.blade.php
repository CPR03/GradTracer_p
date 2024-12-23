@extends('layouts.admin-dashboard') @section('content')
<div class="container mx-auto px-4">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1
            class="text-2xl font-semibold text-gray-800 flex items-center gap-2"
        >
            <i data-lucide="file-plus" class="w-6 h-6 text-primary"></i>
            Create New Question
        </h1>
        <a href="{{ url()->previous() }}" class="btn btn-ghost btn-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back
        </a>
    </div>

    <!-- Question Form -->
    <div class="card bg-base-100 shadow-md">
        <div class="card-body">
            <form
                action="/admin/questionnaires/{{ $questionnaire->id }}/questions"
                method="post"
            >
                @csrf

                <!-- Hidden Fields -->
                <input
                    type="hidden"
                    name="question[questionnaire_id]"
                    value="{{ $questionnaire->id }}"
                />
                <input
                    type="hidden"
                    name="question[question_section_id]"
                    value="{{ $questionSec_ID->id }}"
                />

                <!-- Question Title -->
                <div class="form-control w-full mb-6">
                    <label class="label">
                        <span class="label-text font-medium"
                            >Question Title</span
                        >
                    </label>
                    <input
                        type="text"
                        name="question[question]"
                        value="{{ old('question.question') }}"
                        class="input input-bordered w-full @error('question.question') input-error @enderror"
                        placeholder="Enter your question here"
                    />
                    @error('question.question')
                    <label class="label">
                        <span class="label-text-alt text-error">{{
                            $message
                        }}</span>
                    </label>
                    @enderror
                </div>

                <!-- Question Type Selection -->
                <div class="form-control w-full mb-6">
                    <label class="label">
                        <span class="label-text font-medium"
                            >Question Type</span
                        >
                    </label>
                    <select
                        name="question[questionType]"
                        id="questionType"
                        class="select select-bordered w-full"
                    >
                        <option selected disabled>
                            Select a question type
                        </option>
                        <option value="multipleChoice">
                            Multiple Choice (Single Answer)
                        </option>
                        <option value="check">
                            Multiple Choice (Multiple Answers)
                        </option>
                        <option value="textBox">Text Response</option>
                        <option value="simple">Short Answer</option>
                        <option value="date">Date</option>
                        <option value="multipleRadio">Rating Grid</option>
                    </select>
                </div>

                <!-- Dynamic Question Options -->
                <div class="question-options space-y-4">
                    <!-- Radio Options -->
                    <div id="radioOptions" class="hidden">
                        <div class="card bg-base-100 border">
                            <div class="card-body">
                                <h3 class="font-medium mb-4">
                                    Multiple Choice Options
                                </h3>
                                <div id="radioChoices" class="space-y-2">
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="radio"
                                            disabled
                                            class="radio radio-primary"
                                        />
                                        <input
                                            type="text"
                                            name="answers[0][answer]"
                                            class="input input-bordered w-full"
                                            placeholder="Option 1"
                                        />
                                        <button
                                            type="button"
                                            class="btn btn-ghost btn-sm btn-circle"
                                            onclick="removeOption(this)"
                                        >
                                            <i
                                                data-lucide="x"
                                                class="w-4 h-4"
                                            ></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button
                                        type="button"
                                        onclick="addRadioOption()"
                                        class="btn btn-ghost btn-sm"
                                    >
                                        <i
                                            data-lucide="plus"
                                            class="w-4 h-4"
                                        ></i>
                                        Add Option
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Checkbox Options -->
                    <div id="checkboxOptions" class="hidden">
                        <div class="card bg-base-100 border">
                            <div class="card-body">
                                <h3 class="font-medium mb-4">
                                    Checkbox Options
                                </h3>
                                <div id="checkboxChoices" class="space-y-2">
                                    <div class="flex items-center gap-2">
                                        <input
                                            type="checkbox"
                                            disabled
                                            class="checkbox checkbox-primary"
                                        />
                                        <input
                                            type="text"
                                            name="answers[0][answer]"
                                            class="input input-bordered w-full"
                                            placeholder="Option 1"
                                        />
                                        <button
                                            type="button"
                                            class="btn btn-ghost btn-sm btn-circle"
                                            onclick="removeOption(this)"
                                        >
                                            <i
                                                data-lucide="x"
                                                class="w-4 h-4"
                                            ></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button
                                        type="button"
                                        onclick="addCheckboxOption()"
                                        class="btn btn-ghost btn-sm"
                                    >
                                        <i
                                            data-lucide="plus"
                                            class="w-4 h-4"
                                        ></i>
                                        Add Option
                                    </button>
                                </div>
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
                                    <button
                                        type="button"
                                        onclick="addGridRow()"
                                        class="btn btn-ghost btn-sm"
                                    >
                                        <i
                                            data-lucide="plus"
                                            class="w-4 h-4"
                                        ></i>
                                        Add Row
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Text Response -->
                    <div id="textResponse" class="hidden">
                        <div class="card bg-base-100 border">
                            <div class="card-body">
                                <h3 class="font-medium mb-4">Text Response</h3>
                                <div class="form-control">
                                    <textarea
                                        disabled
                                        class="textarea textarea-bordered"
                                        rows="4"
                                        placeholder="Student's answer will appear here"
                                    >
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Short Answer -->
                    <div id="shortAnswer" class="hidden">
                        <div class="card bg-base-100 border">
                            <div class="card-body">
                                <h3 class="font-medium mb-4">Short Answer</h3>
                                <div class="form-control">
                                    <input
                                        type="text"
                                        disabled
                                        class="input input-bordered w-full"
                                        placeholder="Student's answer will appear here"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Date Input -->
                    <div id="dateInput" class="hidden">
                        <div class="card bg-base-100 border">
                            <div class="card-body">
                                <h3 class="font-medium mb-4">Date Input</h3>
                                <div class="form-control">
                                    <input
                                        type="date"
                                        disabled
                                        class="input input-bordered w-full"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-2 mt-6">
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Save Question
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let radioCounter = 0;
    let checkboxCounter = 0;
    let gridCounter = 0;

    // Question type toggle
    document
        .getElementById("questionType")
        .addEventListener("change", function (e) {
            const options = document.querySelectorAll(
                ".question-options > div"
            );
            options.forEach((opt) => opt.classList.add("hidden"));

            // Reset all counters when changing types
            radioCounter = 0;
            checkboxCounter = 0;
            gridCounter = 0;

            // Reset the containers when switching types
            document.getElementById("checkboxChoices").innerHTML = "";
            document.getElementById("radioChoices").innerHTML = "";

            switch (e.target.value) {
                case "multipleChoice":
                    document
                        .getElementById("radioOptions")
                        .classList.remove("hidden");
                    addRadioOption();
                    break;
                case "check":
                    document
                        .getElementById("checkboxOptions")
                        .classList.remove("hidden");
                    addCheckboxOption();
                    break;
                case "multipleRadio":
                    document
                        .getElementById("ratingGrid")
                        .classList.remove("hidden");
                    addGridRow();
                    break;
                case "textBox":
                    document
                        .getElementById("textResponse")
                        .classList.remove("hidden");
                    break;
                case "simple":
                    document
                        .getElementById("shortAnswer")
                        .classList.remove("hidden");
                    break;
                case "date":
                    document
                        .getElementById("dateInput")
                        .classList.remove("hidden");
                    break;
            }
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
        <button type="button" class="btn btn-ghost btn-sm btn-circle" onclick="removeOption(this)">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    `;
        container.appendChild(div);
        lucide.createIcons();
        checkboxCounter++;
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

    // Remove option
    function removeOption(element) {
        if (element.tagName === "TR") {
            element.remove();
        } else {
            element.closest("div").remove();
        }
    }
</script>
@endsection
