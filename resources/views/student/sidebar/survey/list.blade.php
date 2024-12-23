@extends('student.layouts.student-dashboard') @section('title','Student Surveys')
@section('content')
<div
    class="w-full"
    x-data="{
        search: '',
        questionnaires: {{ json_encode($questionnaires) }},
        filteredQuestionnaires() {
            return this.search === ''
                ? this.questionnaires
                : this.questionnaires.filter(q =>
                    q.title.toLowerCase().includes(this.search.toLowerCase())
                  )
        }
    }"
    x-init="
        // Initial icon creation
        $nextTick(() => {
            lucide.createIcons();
        });

        // Watch for changes
        $watch('filteredQuestionnaires', () => {
            $nextTick(() => {
                lucide.createIcons();
            });
        });
    "
>
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Available Surveys</h1>
        <div class="join">
            <input
                type="text"
                x-model="search"
                class="input input-bordered join-item"
                placeholder="Search surveys..."
            />
            <button class="btn btn-primary join-item">
                <i data-lucide="search" class="w-4 h-4"></i>
            </button>
        </div>
    </div>

    <!-- Cards Grid -->
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <template
            x-for="questionnaire in filteredQuestionnaires()"
            :key="questionnaire.id"
        >
            <div
                class="card bg-base-100 shadow-lg hover:shadow-xl transition-shadow duration-300"
            >
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="bg-primary/10 p-3 rounded-lg">
                            <i
                                data-lucide="clipboard-list"
                                class="w-6 h-6 text-primary"
                            ></i>
                        </div>
                        <h2
                            class="card-title text-lg"
                            x-text="questionnaire.title"
                        ></h2>
                    </div>

                    <div
                        class="flex items-center gap-2 text-sm text-gray-500 mb-4"
                    >
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        <span>Estimated time: 5 mins</span>
                    </div>

                    <div class="card-actions justify-end">
                        <a
                            :href="`/student/questionnaires/${questionnaire.id}`"
                            class="btn btn-primary gap-2"
                        >
                            Start Survey
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Empty State -->
    <div
        x-show="filteredQuestionnaires().length === 0"
        class="text-center py-12"
    >
        <div class="flex justify-center mb-4">
            <i data-lucide="clipboard-x" class="w-16 h-16 text-gray-400"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-600">
            No Surveys Available
        </h3>
        <p class="text-gray-500">Check back later for new surveys</p>
    </div>
</div>
@endsection
