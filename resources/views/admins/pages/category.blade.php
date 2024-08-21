@extends('admins.pages.main')

@include('admins.modals.createcategory') {{-- Assuming you have a create category modal --}}

@section('title', 'Categories')

@section('content')
    <div class="w-full p-5 flex flex-col mt-6 gap-4">
        <h2 class="text-2xl font-semibold mb-2">List Data Categories</h2>
        <div class="overflow-x-auto rounded-lg shadow-lg shadow-black/15 mb-5">
            <div class="flex justify-end mb-4">
                <button onclick="openModal('create-category-modal')"
                    class="px-4 py-2 bg-blue-600 text-white text-[14px] font-medium rounded-md">
                    Tambah Data Kategori
                </button>
            </div>
            <table class="w-full">
                <thead class="bg-white border-b-2 border-gray-200">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">No</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Name</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="bg-white">
                            <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $category->name }}</td>
                            <td class="flex justify-center items-center gap-4 p-3">
                                <button data-modal-target="modal-edit-{{ $category->id }}"
                                    data-modal-toggle="modal-edit-{{ $category->id }}"
                                    class="text-white bg-yellow-300 hover:bg-yellow-400 font-medium rounded-lg text-sm px-4 py-2 text-center"
                                    type="button">
                                    Edit
                                    {{-- <i class="bi bi-pencil-fill"></i> --}}
                                </button>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this category?');" style="display:inline-block; margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class=" text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-4 py-1 text-center">
                                        Delete
                                        {{-- <i class="bi bi-trash-fill"></i> --}}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        {{-- Edit Modal --}}
                        @include('admins.modals.editcategory', ['category' => $category])
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript for modal functionality -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection
