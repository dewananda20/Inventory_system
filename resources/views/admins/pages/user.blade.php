@extends('admins.pages.main')

@section('title', 'Users')

@section('content')
    <div class="w-full p-5">
        <h2 class="text-2xl font-semibold mt-6 mb-2">List Users</h2>
        <!-- Table -->
        <div class="overflow-x-auto rounded-lg shadow-lg shadow-black/15 mb-6">
            <table class="w-full mt-3">
                <thead class="bg-white border-b-2 border-gray-200">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">No</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Name</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Email</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Role</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        {{-- @php
                       $roleNames = $roles->pluck('name');
                       dd($roleNames);
                    @endphp --}}
                        <tr class="bg-white">
                            <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $user->name }}</td>
                            <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $user->email }}</td>
                            <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">
                                {{ $roles->firstWhere('id', $user->role_id)?->name ?? 'Role Not Found' }}
                            </td>
                            </td>
                            <td class="flex justify-center items-center gap-4 p-3">
                                <button data-modal-target="modal-{{ $user->id }}"
                                    data-modal-toggle="modal-{{ $user->id }}"
                                    class="text-white bg-yellow-300 hover:bg-yellow-400 font-medium rounded-lg text-sm px-4 py-2"
                                    type="button">
                                    Edit
                                    {{-- <i class="bi bi-pencil-fill"></i> --}}
                                </button>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-4 py-2 text-center">
                                        Delete
                                        {{-- <i class="bi bi-trash-fill"></i> --}}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        {{-- Detail Modal --}}
                        @include('admins.modals.edituser', ['user' => $user])
                    @endforeach
                </tbody>
            </table>
        </div>

        @push('scripts')
            <script>
                function openModal(modalId) {
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.remove('hidden'); // Show the modal
                    }
                }

                function closeModal(modalId) {
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.add('hidden'); // Hide the modal
                    }
                }

                // Optional: Close modal when clicking outside the modal
                window.onclick = function(event) {
                    const modals = document.querySelectorAll('.fixed.z-50');
                    modals.forEach(function(modal) {
                        if (event.target === modal) {
                            closeModal(modal.id);
                        }
                    });
                };
            </script>
        @endpush
    @endsection
