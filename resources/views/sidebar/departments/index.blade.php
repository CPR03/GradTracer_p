@extends('layouts.admin-dashboard')
@section('content')
    @can('User access')
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                    <i data-lucide="building-2" class="w-6 h-6 text-primary"></i>
                    Departments
                </h1>
                <a href="{{ route('admin.departments.create') }}" class="btn btn-primary btn-sm">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Add Department
                </a>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($users as $department)
                    <div class="card bg-base-100 shadow-md hover:shadow-lg transition-shadow">
                        <div class="card-body">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h2 class="card-title text-gray-800">{{ $department->name }}</h2>
                                    <p class="text-sm text-gray-600">{{ $department->email }}</p>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @foreach ($department->roles as $role)
                                            <span class="badge badge-primary badge-sm">{{ $role->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="dropdown dropdown-end">
                                    <label tabindex="0" class="btn btn-ghost btn-sm btn-circle">
                                        <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                    </label>
                                    <ul tabindex="0"
                                        class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                        <li class="w-full">
                                            <a href="{{ route('admin.departments.edit', $department->id) }}"
                                                class="text-blue-500 w-full">
                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                                Edit
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a onclick="openDeleteModal({{ $department->id }}, '{{ $department->name }}')"
                                                class="text-error w-full cursor-pointer text-whiote">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                Delete
                                                <form id="delete-form-{{ $department->id }}"
                                                    action="{{ route('admin.departments.destroy', $department->id) }}"
                                                    method="POST" class="hidden">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <dialog id="delete_modal" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg text-error">Delete Department</h3>
                <p class="py-4">Are you sure you want to delete <span id="department-name" class="font-semibold"></span>? This
                    action cannot be undone.</p>
                <div class="modal-action">
                    <button class="btn btn-ghost" onclick="closeDeleteModal()">Cancel</button>
                    <button id="confirm-delete-btn" class="btn btn-error text-white" onclick="confirmDelete()">
                        <span class="loading loading-spinner hidden"></span>
                        Delete
                    </button>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button onclick="closeDeleteModal()">close</button>
            </form>
        </dialog>

        <script>
            let currentFormId = null;
            const modal = document.getElementById('delete_modal');
            const confirmBtn = document.getElementById('confirm-delete-btn');

            function openDeleteModal(id, name) {
                currentFormId = id;
                document.getElementById('department-name').textContent = name;
                modal.showModal();
            }

            function closeDeleteModal() {
                modal.close();
                currentFormId = null;
            }

            function confirmDelete() {
                if (!currentFormId) return;

                // Show loading state
                confirmBtn.disabled = true;
                confirmBtn.querySelector('.loading').classList.remove('hidden');

                // Submit the form
                document.getElementById(`delete-form-${currentFormId}`).submit();
            }

            // Handle escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.open) {
                    closeDeleteModal();
                }
            });
        </script>
    @endcan
@endsection
