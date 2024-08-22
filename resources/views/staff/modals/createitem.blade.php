<!-- resources/views/staff/modals/createitem.blade.php -->
<div id="create-item-modal-staff" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-4">
        <h3 class="text-xl font-semibold mb-4">Tambah Data Item</h3>
        <form action="{{ route('items.store.staff') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>
                
                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        @foreach($categories->sortBy(fn($category) => $category->name == 'Lainnya' ? 'zzz' : $category->name) as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Description -->
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required></textarea>
                </div>
                
                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" name="price" id="price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>
                
                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" name="stock" id="stock" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>
                
                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>
                
                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                </div>
            </div>
            <div class="mt-4 flex justify-end gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md">Submit</button>
                <button type="button" onclick="closeModal('create-item-modal-staff')" class="px-4 py-2 bg-gray-600 text-white font-semibold rounded-md">Cancel</button>
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
    