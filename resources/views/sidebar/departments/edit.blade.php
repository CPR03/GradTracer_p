@extends('layouts.admin-dashboard')
@section('content')

<div class="container mx-auto px-4">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
            <i data-lucide="building-2" class="w-6 h-6 text-primary"></i>
            Edit Department User
        </h1>
        <a href="{{ route('admin.departments.index') }}" class="btn btn-ghost btn-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back to List
        </a>
    </div>

    <!-- Form Card -->
    <div class="card bg-base-100 shadow-md">
        <div class="card-body">
            <form action="{{ route('admin.departments.update', $department->id)}}" method="post">
                @csrf
                @method('put')

                <!-- Name Field -->
                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text font-medium">Department Name</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $department->name) }}"
                        class="input input-bordered w-full @error('name') input-error @enderror"
                        placeholder="Enter department name">
                    @error('name')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text font-medium">Email Address</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email', $department->email) }}"
                        class="input input-bordered w-full @error('email') input-error @enderror"
                        placeholder="Enter email address">
                    @error('email')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-control w-full mb-4">
                    <label class="label">
                        <span class="label-text font-medium">Password</span>
                    </label>
                    <input type="password" name="password"
                        class="input input-bordered w-full @error('password') input-error @enderror"
                        placeholder="Enter new password">
                    @error('password')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="form-control w-full mb-6">
                    <label class="label">
                        <span class="label-text font-medium">Confirm Password</span>
                    </label>
                    <input type="password" name="password_confirmation"
                        class="input input-bordered w-full @error('password_confirmation') input-error @enderror"
                        placeholder="Confirm new password">
                    @error('password_confirmation')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Roles Section -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-3">Roles</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($roles as $role)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                class="checkbox checkbox-primary checkbox-sm"
                                {{ in_array($role->id, $department->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <span class="label-text">{{ $role->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Update Department
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
