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
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div class="w-full px-5 py-4 mb-5 bg-green-100 border-l-4 border-green-500">
                            {{ $message }}
                        </div>
                    @endif

                    <div class="grid grid-cols-12 gap-x-4">
                        <div class="col-span-3">
                            <a href="{{ route('messages.create') }}"
                                class="block w-full p-2 text-center text-white bg-indigo-400 hover:bg-indigo-600">New
                                Message</a>
                        </div>
                        <div class="col-span-9">
                            <table class="min-w-full leading-normal">
                                <thead class="border-b bg-gray-50">
                                    <th
                                        class="px-3 py-3 text-xs font-normal text-left text-gray-500 uppercase align-middle">
                                        Sender</th>
                                    <th
                                        class="px-3 py-3 text-xs font-normal text-left text-gray-500 uppercase align-middle">
                                        Subject</th>
                                    <th
                                        class="px-3 py-3 text-xs font-normal text-left text-gray-500 uppercase align-middle">
                                    </th>
                                </thead>
                                <tbody>
                                    @each('sidebar.messenger.partials.thread', $threads, 'thread',
                                    'sidebar.messenger.partials.no-threads')
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
@endsection
