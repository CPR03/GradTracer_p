@extends('layouts.admin-dashboard')
@section('content')
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                <a href="{{ route('admin.survey.index') }}" class="btn btn-ghost btn-circle">
                    <i data-lucide="arrow-left" class="w-6 h-6"></i>
                </a>
                <i data-lucide="clipboard-list" class="w-6 h-6 text-primary"></i>
                {{ $questionnaire->title }}
            </h1>
            <div class="flex items-center gap-2">
                <a href="/admin/questionnaires/{{ $questionnaire->id }}/questions/section" class="btn btn-primary btn-sm">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Add New Section
                </a>
                <button class="btn btn-error btn-sm" onclick="deleteModal.showModal()">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                    Delete Questionnaire
                </button>
            </div>
        </div>

        <!-- Questionnaire Form -->
        <div class="card bg-base-100 shadow-md">
            <div class="card-body">
                <form id="survey-form"
                    action="/student/surveys/{{ $questionnaire->id }}-{{ Str::slug($questionnaire->title) }}"
                    method="post">
                    @csrf

                    <!-- Sections Loop -->
                    @foreach ($sections->sections as $key => $section)
                        @if ($section->questionnaire_id == $questionnaire->id)
                            <div class="mb-8" id="{{ str_replace(' ', '', $section->section_name) }}">
                                <!-- Section Header -->
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-xl font-medium text-gray-700">{{ $section->section_name }}</h2>
                                    <a href="/admin/questionnaires/{{ $questionnaire->id }}/{{ $section->id }}/questions/create"
                                        class="btn btn-ghost btn-sm">
                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                        Add Question
                                    </a>
                                </div>

                                <!-- Questions -->
                                @foreach ($section->questions as $qKey => $question)
                                    @if ($question->questionnaire_id == $questionnaire->id)
                                        <div class="card bg-base-100 shadow-sm mb-4">
                                            <div class="card-header bg-gray-100 p-4">
                                                <p class="font-medium text-gray-800">
                                                    {{ $qKey + 1 }}. {{ $question->question }}
                                                    <span class="text-error">*</span>
                                                </p>
                                            </div>

                                            <div class="card-body p-4">
                                                <!-- Answer Options -->
                                                <div class="space-y-2">
                                                    @foreach ($question->answers as $answer)
                                                        @switch($question->questionType)
                                                            @case('multipleChoice')
                                                                <label class="flex items-center gap-2">
                                                                    <input type="radio" class="radio radio-primary"
                                                                        name="responses[{{ $question->id }}][answer_name]"
                                                                        value="{{ $answer->answer }}" required>
                                                                    <span>{{ $answer->answer }}</span>
                                                                </label>
                                                            @break

                                                            @case('check')
                                                                <label class="flex items-center gap-2">
                                                                    <input type="checkbox" class="checkbox checkbox-primary"
                                                                        name="responses[{{ $question->id }}][answer_name]"
                                                                        value="{{ $answer->answer }}">
                                                                    <span>{{ $answer->answer }}</span>
                                                                </label>
                                                            @break

                                                            @case('textBox')
                                                                <textarea class="textarea textarea-bordered w-full" rows="4" name="responses[{{ $question->id }}][answer_name]"
                                                                    placeholder="{{ $answer->answer }}" required></textarea>
                                                            @break

                                                            @case('simple')
                                                                <input type="text" class="input input-bordered w-full"
                                                                    name="responses[{{ $question->id }}][answer_name]" required>
                                                            @break

                                                            @case('date')
                                                                <input type="date" class="input input-bordered w-full"
                                                                    name="responses[{{ $question->id }}][answer_name]" required>
                                                            @break
                                                        @endswitch
                                                    @endforeach
                                                </div>

                                                <!-- Question Actions -->
                                                <div class="flex justify-end gap-2 mt-4">
                                                    <a href="/admin/questionnaires/{{ $questionnaire->id }}/{{ $section->id }}/{{ $question->id }}/edit"
                                                        class="btn btn-warning btn-sm">
                                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                                        Edit
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.questions.delete', [$questionnaire->id, $question->id]) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-error btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this question?')">
                                                            <i data-lucide="trash" class="w-4 h-4"></i>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                                <!-- Evaluation Table -->
                                @foreach ($section->table_evaluation as $eval)
                                    <div class="card bg-base-100 shadow-sm mb-4">
                                        <div class="card-header bg-gray-100 p-4">
                                            <h3 class="font-medium text-gray-800">{{ $eval->question }}</h3>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="overflow-x-auto">
                                                <table class="table table-zebra w-full">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-1/3">Criteria</th>
                                                            <th class="text-center">Poorly</th>
                                                            <th class="text-center">Fairly</th>
                                                            <th class="text-center">Highly</th>
                                                            <th class="text-center">Very Highly</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($eval->multiple_questions as $question)
                                                            <tr>
                                                                <td>{{ $question->question_row }}</td>
                                                                @foreach ($question->multiple_answers as $answer)
                                                                    <td class="text-center">
                                                                        <input type="radio" class="radio radio-primary"
                                                                            name="evaluation[{{ $question->id }}][answer_name]"
                                                                            value="{{ $answer->answer_column }}" required>
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- Add Action Buttons -->
                                            <div class="flex justify-end gap-2 mt-4">
                                                <a href="/admin/questionnaires/{{ $questionnaire->id }}/{{ $section->id }}/{{ $eval->id }}/edit"
                                                    class="btn btn-warning btn-sm">
                                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                                    Edit
                                                </a>
                                                <form
                                                    action="{{ route('admin.evaluation.delete', [$questionnaire->id, $eval->id]) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-error btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this rating grid?')">
                                                        <i data-lucide="trash" class="w-4 h-4"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach

                    <!-- Submit Button -->
                    <!-- <div class="flex justify-end mt-6">
                                <button type="submit" class="btn btn-primary">
                                    <i data-lucide="save" class="w-4 h-4"></i>
                                    Save Questionnaire
                                </button>
                            </div> -->
                </form>
            </div>
        </div>
    </div>

    <dialog id="deleteModal" class="modal modal-bottom sm:modal-middle">
        <form action="{{ route('admin.questionnaires.destroy', $questionnaire->id) }}" method="POST" class="modal-box">
            @csrf
            @method('DELETE')
            <h3 class="font-bold text-lg">Delete Questionnaire</h3>
            <p class="py-4">Are you sure you want to delete "{{ $questionnaire->title }}"? This action cannot be undone.
            </p>
            <div class="modal-action">
                <button type="button" class="btn btn-ghost" onclick="deleteModal.close()">Cancel</button>
                <button type="submit" class="btn btn-error gap-2">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                    Delete
                </button>
            </div>
        </form>
    </dialog>

    {{-- <script>
  $('input:radio').each(function(){
    if($(this).is(checked)){
      function changeID(){

      let element = document.getElementById('{{ $answer->id }}');

      var s = document.getElementById('answer');
      s.value = element.id;

     }
    }
  })
</script> --}}
    <script>
        $(function() {
            $(":radio").on("change", function() {
                var val = this.id,
                    checked = this.checked;
                var others = $(":radio[id='" + val + "']").not(this);
                others.prop('checked', true);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            for (let i = 0; i < 100; i++) {
                var str = $(".remove-white-space-" + i + "").attr("id")?.replace(/[- )(]/g, '');
                if (str) {
                    $(".remove-white-space-" + i + "").attr("id", str);
                }
                @foreach ($sections->sections as $section)
                    @foreach ($section->questions as $question)
                        @foreach ($question->answers as $answer)

                            @if ($answer->section_name != '')
                                var replaceText = "{{ $answer->section_name }}";
                                var newMyText = replaceText.replace(/[- )(]/g, '');
                                $("#" + newMyText).hide("fast");
                            @endif
                        @endforeach
                    @endforeach
                @endforeach


            }
            // loop for section
            @foreach ($sections->sections as $section)
                @foreach ($section->questions as $question)
                    @foreach ($question->answers as $answer)

                        @if ($answer->section_name != '')
                            var replaceText = "{{ $answer->section_name }}";

                            var newAnswer = replaceText.replace(/[- )(]/g, '');

                            $("#{{ $answer->id }}").click(function() {
                                var sectionName = "{{ $answer->section_name }}";
                                var newSection = sectionName.replace(/[- )(]/g, '');

                                if (newSection == newSection) {
                                    $("#" + newSection).show("slow");
                                    $("#" + newSection + " :input").attr("disabled", true);
                                } else {
                                    $("#" + newSection).hide("slow");
                                }
                                // if(newSection != newSection){
                                //   console.log("not section");
                                // }
                                // else{
                                //   console.log("eto ung section");
                                // }
                                //     console.log("{{ $answer->section_name }}");
                                // var test = "{{ $answer->section_name }}";
                                // var newMyText = test.replace(/[- )(]/g, '');
                                // if(newMyText != "NotEmployed"){
                                //   alert(newMyText);
                                //   $("#" + newMyText).show("slow");
                                // }else{

                                //   alert(newMyText + "else");
                                //   $("#" + newMyText).hide("slow");

                                // }


                            })
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        });
    </script>
@endsection
