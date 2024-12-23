@extends('student.layouts.student-dashboard') @section('title','Student Dashboard')
@section('content')
<div class="space-y-6">
    <!-- Greeting Section -->
    <div class="card bg-primary text-primary-content">
        <div class="card-body">
            <div class="flex items-center gap-4">
                <!-- <div class="bg-white/10 p-4 rounded-full">
                    <i data-lucide="wave" class="w-8 h-8"></i>
                </div> -->
                <div>
                    <h2 class="card-title text-2xl">
                        Welcome back,
                        {{ Auth::guard('student')->user()->name }}!
                    </h2>
                    <p class="text-primary-content/80">
                        How are you doing today?
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Surveys Card -->
        <div
            class="card bg-base-100 shadow-sm border hover:shadow-xl transition-shadow duration-300"
        >
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="bg-primary/10 p-3 rounded-lg">
                        <i
                            data-lucide="file-check"
                            class="w-6 h-6 text-primary"
                        ></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">Surveys</h3>
                        <p class="text-gray-500">
                            {{ $pendingSurveys }} Available
                            {{ Str::plural('survey', $pendingSurveys) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events -->
        <div
            class="card bg-base-100 shadow-sm border hover:shadow-xl transition-shadow duration-300"
        >
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="bg-secondary/10 p-3 rounded-lg">
                        <i
                            data-lucide="calendar"
                            class="w-6 h-6 text-secondary"
                        ></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">Events</h3>
                        <p class="text-gray-500">
                            {{ count($posts) }} upcoming
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Events Feed -->
    <div class="card bg-base-100 shadow-sm border">
        <div class="card-body">
            <div class="flex items-center gap-3 mb-6">
                <div class="bg-primary/10 p-3 rounded-lg">
                    <i data-lucide="megaphone" class="w-6 h-6 text-primary"></i>
                </div>
                <h2 class="card-title">Latest Events</h2>
            </div>

            <div class="space-y-4">
                @forelse($posts as $post)
                <div
                    class="bg-gray-100 p-4 rounded-lg hover:bg-base-300 transition-colors duration-300"
                >
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center gap-2">
                            <div class="avatar placeholder">
                                <div
                                    class="bg-neutral text-neutral-content rounded-full w-8"
                                >
                                    <span
                                        >{{ substr($post->user_name, 0, 1) }}</span
                                    >
                                </div>
                            </div>
                            <span
                                class="font-medium"
                                >{{ $post->user_name }}</span
                            >
                        </div>
                        <span
                            class="text-sm text-gray-500"
                            >{{ $post->created_at->diffForHumans() }}</span
                        >
                    </div>
                    <p class="text-gray-600">{{ $post->description }}</p>
                </div>
                @empty
                <div class="text-center py-6">
                    <i
                        data-lucide="calendar-x"
                        class="w-12 h-12 text-gray-400 mx-auto mb-2"
                    ></i>
                    <p class="text-gray-500">
                        No events available at the moment
                    </p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        lucide.createIcons();
    });
</script>
@endsection
