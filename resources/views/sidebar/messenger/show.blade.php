@extends('layouts.admin-dashboard')
@section('content')
@extends('layouts.survey')
@section('survey')
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="col-md-6">
                        <div class="space-y-4">
                            @foreach ($thread->messages as $message)
                                <div class="px-4 py-2 leading-relaxed border rounded-lg sm:px-6 sm:py-4">
                                    <strong>{{ $message->user->name }}</strong>
                                    <span class="text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}
                                    </span>
                                    <p class="text-sm">
                                        {{ $message->body }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        <form action="{{ route('messages.update', $thread) }}" method="post">
                            @csrf
                            @method('PUT')

                            <!-- Message Form Input -->
                            <div class="mt-4">
                                <x-label for="message" :value="__('Reply message')" />
                                <textarea name="message" rows="10"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('message') }}</textarea>
                            </div>

                            <!-- Submit Form Input -->
                            <div class="mt-4">
                                <x-button>Submit</x-button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endsection