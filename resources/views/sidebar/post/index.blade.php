@extends('layouts.admin-dashboard')
@section('content')
    @can('User access')
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                    <i data-lucide="mail" class="w-6 h-6 text-primary"></i>
                    Messages
                </h1>
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Add New Message
                </a>
            </div>

            <!-- Messages Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($posts as $post)
                    <div class="card bg-base-100 shadow-md hover:shadow-lg transition-shadow">
                        <div class="card-body">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h2 class="card-title text-gray-800">{{ $post->title }}</h2>
                                    <div class="mt-2">
                                        @if ($post->publish)
                                            <span class="badge badge-success badge-sm">Published</span>
                                        @else
                                            <span class="badge badge-warning badge-sm">Draft</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="dropdown dropdown-end">
                                    <label tabindex="0" class="btn btn-ghost btn-sm btn-circle">
                                        <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                    </label>
                                    <ul tabindex="0"
                                        class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                        <li>
                                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-blue-500">
                                                <i data-lucide="edit" class="w-4 h-4"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a onclick="openDeleteModal({{ $post->id }}, '{{ $post->title }}')"
                                                class="text-error cursor-pointer">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i> Delete
                                            </a>
                                            <form id="delete-form-{{ $post->id }}"
                                                action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                                class="hidden">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <dialog id="delete_modal" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg text-error">Delete Message</h3>
                <p class="py-4">Are you sure you want to delete "<span id="post-title" class="font-semibold"></span>"? This
                    action cannot be undone.</p>
                <div class="modal-action">
                    <button class="btn btn-ghost" onclick="closeDeleteModal()">Cancel</button>
                    <button id="confirm-delete-btn" class="btn btn-error" onclick="confirmDelete()">
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

            function openDeleteModal(id, title) {
                currentFormId = id;
                document.getElementById('post-title').textContent = title;
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
