<div id="modal-{{ $user->id }}" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden">
    <!-- Modal Overlay -->
    <div class="fixed inset-0 bg-gray-800 bg-opacity-50"></div>

    <!-- Modal Content -->
    <div class="relative bg-white rounded-lg shadow-lg p-5 w-full max-w-lg mx-auto mt-10">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-xl font-medium text-gray-900">Edit User</h3>
            <button type="button" class="text-gray-400 hover:text-gray-900" onclick="closeModal('modal-{{ $user->id }}')">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select name="role" id="role" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-5 flex justify-end">
                <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md" onclick="closeModal('modal-{{ $user->id }}')">Cancel</button>
                <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-md">Save</button>
            </div>
        </form>
    </div>
</div>
<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }
    
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
    </script>
