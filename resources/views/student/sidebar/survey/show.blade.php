@extends('student.layouts.student-dashboard') @section('title','Answer Survey')
@section('content')

<div class="max-w-5xl mx-auto py-8">
    <div class="form-all">
        <form
            id="survey-form"
            action="/student/surveys/{{ $questionnaire->id }}-{{ Str::slug($questionnaire->title) }}"
            method="post"
            class="space-y-8"
        >
            @csrf

            <!-- Hidden user info -->
            <input
                type="hidden"
                name="survey[name]"
                value="{{ Auth::guard('student')->user()->name }}"
            />
            <input
                type="hidden"
                name="survey[department]"
                value="{{ Auth::guard('student')->user()->department }}"
            />

            @foreach($sections->sections as $key => $section)
            <div class="page-section">
                <div
                    class="remove-white-space-{{ $key }}"
                    id="{{ $section->section_name }}"
                >
                    <!-- Section Header -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-primary">
                            {{ $section->section_name }}
                        </h1>
                    </div>

                    <!-- Questions -->
                    <div class="space-y-6">
                        @foreach($section->questions as $qKey => $question)
                        <div
                            class="card bg-base-100 shadow-lg hover:shadow-xl transition-shadow duration-200"
                        >
                            <div
                                class="card-header p-4 bg-primary text-primary-content"
                            >
                                <h3
                                    class="text-lg font-semibold flex items-start gap-3"
                                >
                                    <span
                                        class="inline-flex items-center justify-center bg-primary-focus text-primary-content w-8 h-8 rounded-full"
                                    >
                                        {{ $qKey + 1 }}
                                    </span>
                                    {{ $question->question }}
                                    <span class="text-error">*</span>
                                </h3>
                            </div>

                            <div class="card-body p-6">
                                <div class="space-y-3">
                                    @switch($question->questionType)
                                    @case('multipleChoice')
                                    @foreach($question->answers as $answer)
                                    <label
                                        class="flex items-center gap-3 hover:bg-base-200 p-3 rounded-lg transition-colors"
                                    >
                                        <input
                                            type="radio"
                                            class="radio radio-primary"
                                            name="responses[{{ $question->id }}][answer_name]"
                                            id="{{ $answer->id }}"
                                            value="{{ $answer->answer }}"
                                            required
                                        />
                                        <span
                                            class="label-text"
                                            >{{ $answer->answer }}</span
                                        >

                                        <!-- Hidden fields -->
                                        <input
                                            type="hidden"
                                            name="responses[{{ $question->id }}][answer_id]"
                                            value="{{ $answer->id }}"
                                        />
                                        <input
                                            type="hidden"
                                            name="responses[{{ $question->id }}][question_id]"
                                            value="{{ $question->id }}"
                                        />
                                        <input
                                            type="hidden"
                                            name="responses[{{ $question->id }}][question_name]"
                                            value="{{ $question->question }}"
                                        />
                                    </label>
                                    @endforeach @break @case('check')
                                    @foreach($question->answers as $answer)
                                    <label
                                        class="flex items-center gap-3 hover:bg-base-200 p-3 rounded-lg transition-colors"
                                    >
                                        <input
                                            type="checkbox"
                                            class="checkbox checkbox-primary"
                                            name="responses[{{ $question->id }}][answer_name][]"
                                            id="{{ $answer->id }}"
                                            value="{{ $answer->answer }}"
                                        />
                                        <span
                                            class="label-text"
                                            >{{ $answer->answer }}</span
                                        >

                                        <!-- Hidden fields -->
                                        <input
                                            type="hidden"
                                            name="responses[{{ $question->id }}][answer_id][]"
                                            value="{{ $answer->id }}"
                                        />
                                    </label>
                                    @endforeach @break @case('textBox')
                                    <div class="form-control">
                                        <textarea
                                            class="textarea textarea-bordered h-24 w-full"
                                            name="responses[{{ $question->id }}][answer_name]"
                                            placeholder="Enter your answer here"
                                            required
                                        ></textarea>
                                    </div>
                                    @break @case('simple')
                                    <div class="form-control">
                                        <input
                                            type="text"
                                            class="input input-bordered w-full"
                                            name="responses[{{ $question->id }}][answer_name]"
                                            placeholder="Enter your answer here"
                                            required
                                        />
                                    </div>
                                    @break @case('date')
                                    <div class="form-control">
                                        <input
                                            type="date"
                                            class="input input-bordered w-full"
                                            name="responses[{{ $question->id }}][answer_name]"
                                            required
                                        />
                                    </div>
                                    @break @endswitch
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Evaluation Tables -->
                        @if(isset($section->table_evaluation) &&
                        count($section->table_evaluation) > 0)
                        @foreach($section->table_evaluation as $key => $eval)
                        <div
                            class="card bg-base-100 shadow-lg hover:shadow-xl transition-shadow duration-200"
                        >
                            <div
                                class="card-header p-4 bg-primary text-primary-content"
                            >
                                <h3 class="text-lg font-semibold">
                                    {{ $eval->question }}
                                </h3>
                            </div>
                            <div class="card-body p-6">
                                <div class="overflow-x-auto">
                                    <table class="table table-zebra w-full">
                                        <thead>
                                            <tr>
                                                <th class="w-1/3">Criteria</th>
                                                @php $ratingOptions = ['Poor',
                                                'Fair', 'Good', 'Excellent'];
                                                @endphp @foreach($ratingOptions
                                                as $rating)
                                                <th class="text-center w-1/6">
                                                    {{ $rating }}
                                                </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($eval->multiple_questions
                                            as $mQuestion)
                                            <tr>
                                                <td class="font-medium">
                                                    {{ $mQuestion->question_row }}
                                                </td>
                                                @foreach($ratingOptions as $key
                                                => $rating)
                                                <td class="text-center">
                                                    <label
                                                        class="cursor-pointer"
                                                    >
                                                        <input
                                                            type="radio"
                                                            class="radio radio-primary"
                                                            name="evaluation[{{ $eval->id }}][{{ $mQuestion->id }}]"
                                                            value="{{
                                                                $key + 1
                                                            }}"
                                                            required
                                                        />
                                                    </label>
                                                </td>
                                                @endforeach

                                                <!-- Hidden fields -->
                                                <input
                                                    type="hidden"
                                                    name="evaluation[{{ $eval->id }}][questions][{{ $mQuestion->id }}][question_row]"
                                                    value="{{ $mQuestion->question_row }}"
                                                />
                                                <input
                                                    type="hidden"
                                                    name="evaluation[{{ $eval->id }}][eval_name]"
                                                    value="{{ $eval->question }}"
                                                />
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endforeach @endif
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Submit Button -->
            <div class="flex justify-end mt-8">
                <button type="submit" class="btn btn-primary gap-2">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    Submit Survey
                </button>
            </div>
        </form>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-error mb-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<script>
    // Existing JavaScript for radio button handling
    $(function() {
        $(":radio").on("change", function() {
            var val = this.id, checked = this.checked;
            var others = $(":radio[id='"+val+"']").not(this);
            others.prop('checked', true);
        });
    });

    // Section visibility logic
    $(document).ready(function() {
        for(let i = 0; i < 100; i++) {
            var str = $(".remove-white-space-"+i+"").attr("id")?.replace(/[- )(]/g, '');
            if(str) {
                $(".remove-white-space-"+i+"").attr("id", str);
            }
            @foreach($questionSection->sections as $section)
                @foreach($section->questions as $question)
                    @foreach($question->answers as $answer)
                        @if($answer->section_name != 0)
                            var replaceText = "{{ $answer->section_name }}";
                            var newMyText = replaceText.replace(/[- )(]/g, '');
                            $("#" + newMyText).hide("fast");
                            $("#" + newMyText +" :input").attr("disabled", true);
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        }

        @foreach($questionSection->sections as $section)
            @foreach($section->questions as $question)
                @foreach($question->answers as $answer)
                    @if($answer->section_name != 0)
                        var replaceText = "{{ $answer->section_name }}";
                        var newAnswer = replaceText.replace(/[- )(]/g, '');

                        $("#{{ $answer->id }}").click(function(){
                            var sectionName = "{{ $answer->section_name }}";
                            var newSection = sectionName.replace(/[- )(]/g, '');

                            if(newSection == newSection){
                                $("#" + newSection).show("slow");
                                $("#" + newSection +" :input").attr("disabled", false);
                            }
                            else{
                                $("#" + newSection).hide("slow");
                            }
                        });
                    @endif
                @endforeach
            @endforeach
        @endforeach
    });
</script>

@endsection
