@extends('layouts.admin-dashboard')
@section('content')
    @can('User access')
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="flex gap-4 mb-6 justify-between">
                <div class="flex justify-between items-center w-full">
                    <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                        <i data-lucide="users" class="w-6 h-6 text-primary"></i>
                        Student List
                    </h1>
                </div>

                <!-- Search Form -->
                <form action="{{ route('admin.student_lists.index') }}" method="GET" class="w-full">
                    <div class="join w-full max-w-md">
                        <input type="text" name="search" placeholder="Search by name, email or department..."
                            class="input input-bordered join-item w-full" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary join-item">
                            <i data-lucide="search" class="w-4 h-4"></i>
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @if (auth()->user()->type === 'admin')
                    @if ($students->isEmpty())
                        <div class="col-span-full text-center py-8">
                            <p class="text-gray-500">No students found matching your search.</p>
                        </div>
                    @else
                        @foreach ($students as $student)
                            <div class="card bg-base-100 shadow-md hover:shadow-lg transition-shadow">
                                <div class="card-body">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h2 class="card-title text-gray-800">{{ $student->name }}</h2>
                                            <p class="text-sm text-gray-600">{{ $student->email }}</p>
                                            <div class="mt-2">
                                                <span class="badge badge-primary badge-sm">{{ $student->department }}</span>
                                            </div>
                                        </div>
                                        <div class="dropdown dropdown-end">
                                            <label tabindex="0" class="btn btn-ghost btn-sm btn-circle">
                                                <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                            </label>
                                            <ul tabindex="0"
                                                class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                                <li>
                                                    <a href="{{ route('admin.student_lists.edit', $student->id) }}"
                                                        class="text-blue-500">
                                                        <i data-lucide="edit" class="w-4 h-4"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.student_lists.destroy', $student->id) }}"
                                                        method="POST" class="w-full">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="text-error w-full text-left flex items-center gap-2">
                                                            <i data-lucide="trash-2" class="w-4 h-4"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @else
                    <!-- Cards Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @if (auth()->user()->name == 'ccms')
                            @if ($ccms->isEmpty())
                                <div class="col-span-full text-center py-8">
                                    <p class="text-gray-500">No students found matching your search.</p>
                                </div>
                            @else
                                @foreach ($ccms as $ccms)
                                    <div class="card bg-base-100 shadow-md hover:shadow-lg transition-shadow">
                                        <div class="card-body">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h2 class="card-title text-gray-800">{{ $ccms->name }}</h2>
                                                    <p class="text-sm text-gray-600">{{ $ccms->email }}</p>
                                                    <div class="mt-2">
                                                        <span
                                                            class="badge badge-primary badge-sm">{{ $ccms->department }}</span>
                                                    </div>
                                                </div>
                                                <div class="dropdown dropdown-end">
                                                    <label tabindex="0" class="btn btn-ghost btn-sm btn-circle">
                                                        <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                                    </label>
                                                    <ul tabindex="0"
                                                        class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                                        <li>
                                                            <a href="{{ route('admin.student_lists.edit', $ccms->id) }}"
                                                                class="text-blue-500">
                                                                <i data-lucide="edit" class="w-4 h-4"></i> Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form
                                                                action="{{ route('admin.student_lists.destroy', $ccms->id) }}"
                                                                method="POST" class="w-full">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="text-error w-full text-left flex items-center gap-2">
                                                                    <i data-lucide="trash-2" class="w-4 h-4"></i> Delete
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif

                        @if (auth()->user()->name == 'ceng')
                            @if ($ceng->isEmpty())
                                <div class="col-span-full text-center py-8">
                                    <p class="text-gray-500">No students found matching your search.</p>
                                </div>
                            @else
                                @foreach ($ceng as $cengs)
                                    <div class="card bg-base-100 shadow-md hover:shadow-lg transition-shadow">
                                        <div class="card-body">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h2 class="card-title text-gray-800">{{ $cengs->name }}</h2>
                                                    <p class="text-sm text-gray-600">{{ $cengs->email }}</p>
                                                    <div class="mt-2">
                                                        <span
                                                            class="badge badge-primary badge-sm">{{ $cengs->department }}</span>
                                                    </div>
                                                </div>
                                                <div class="dropdown dropdown-end">
                                                    <label tabindex="0" class="btn btn-ghost btn-sm btn-circle">
                                                        <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                                    </label>
                                                    <ul tabindex="0"
                                                        class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                                        <li>
                                                            <a href="{{ route('admin.student_lists.edit', $cengs->id) }}"
                                                                class="text-amber-600">
                                                                <i data-lucide="edit" class="w-4 h-4"></i> Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form
                                                                action="{{ route('admin.student_lists.destroy', $cengs->id) }}"
                                                                method="POST" class="w-full">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="text-error w-full text-left flex items-center gap-2">
                                                                    <i data-lucide="trash-2" class="w-4 h-4"></i> Delete
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif


                        @if (auth()->user()->name == 'cba')
                            @if ($cba->isEmpty())
                                <div class="col-span-full text-center py-8">
                                    <p class="text-gray-500">No students found matching your search.</p>
                                </div>
                            @else
                                @foreach ($cba as $cbas)
                                    <div class="card bg-base-100 shadow-md hover:shadow-lg transition-shadow">
                                        <div class="card-body">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h2 class="card-title text-gray-800">{{ $cbas->name }}</h2>
                                                    <p class="text-sm text-gray-600">{{ $cbas->email }}</p>
                                                    <div class="mt-2">
                                                        <span
                                                            class="badge badge-primary badge-sm">{{ $cbas->department }}</span>
                                                    </div>
                                                </div>
                                                <div class="dropdown dropdown-end">
                                                    <label tabindex="0" class="btn btn-ghost btn-sm btn-circle">
                                                        <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                                    </label>
                                                    <ul tabindex="0"
                                                        class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                                        <li>
                                                            <a href="{{ route('admin.student_lists.edit', $cbas->id) }}"
                                                                class="text-amber-600">
                                                                <i data-lucide="edit" class="w-4 h-4"></i> Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form
                                                                action="{{ route('admin.student_lists.destroy', $cbas->id) }}"
                                                                method="POST" class="w-full">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="text-error w-full text-left flex items-center gap-2">
                                                                    <i data-lucide="trash-2" class="w-4 h-4"></i> Delete
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                @endif
            </div>
        </div>
    @endcan
@endsection
