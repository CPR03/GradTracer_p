@extends('layouts.admin-dashboard')
@section('content')
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                <i data-lucide="mail-plus" class="w-6 h-6 text-primary"></i>
                Create New Message
            </h1>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-ghost btn-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to List
            </a>
        </div>

        <!-- Form Card -->
        <div class="card bg-base-100 shadow-md">
            <div class="card-body">
                <form action="{{ route('admin.posts.store') }}" method="post">
                    @csrf
                    @method('post')
                    <input type="hidden" name="user_name" value="{{ auth()->user()->name }}">

                    <!-- Title Field -->
                    <div class="form-control w-full mb-4">
                        <label class="label">
                            <span class="label-text font-medium">Message Title</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="input input-bordered w-full @error('title') input-error @enderror"
                            placeholder="Enter message title">
                        @error('title')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div class="form-control w-full mb-4">
                        <label class="label">
                            <span class="label-text font-medium">Message Description</span>
                        </label>
                        <textarea name="description" class="textarea textarea-bordered h-24 @error('description') textarea-error @enderror"
                            placeholder="Enter message description">{{ old('description') }}</textarea>
                        @error('description')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Status Field -->
                    <div class="form-control w-full mb-6">
                        <label class="label">
                            <span class="label-text font-medium">Status</span>
                        </label>
                        <select class="select select-bordered w-full" name="publish">
                            <option value="0">Draft</option>
                            <option value="1">Published</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            Create Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
