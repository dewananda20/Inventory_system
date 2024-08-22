<div id="create-category-modal-staff" tabindex="-1" class="fixed inset-0 z-50 hidden w-full h-full overflow-y-auto">
    <div class="relative w-full h-full max-w-md m-auto flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-lg font-semibold">Tambah Data Category</h3>
                <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeModal('create-category-modal-staff')">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <form action="{{ route('categories.store.staff') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full p-2.5 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="block text-white bg-blue-700 hover:p-1.5 hover:bg-blue-800 font-medium rounded-lg text-md p-1.5 text-center">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
