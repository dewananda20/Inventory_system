@extends('admins.pages.main')

@include('admins.modals.createitem')

@section('title', 'Items')

@section('content')
    <div class="w-full p-5 flex flex-col mt-6 gap-4">
        <h2 class="text-2xl font-semibold mb-2">List Data Items</h2>

        <!-- Search Form -->
        <form action="{{ route('items.index') }}" method="GET" class="mb-4">
            <div class="flex items-center gap-2">
                <input type="text" name="search" placeholder="Search by item name..." value="{{ request()->search }}"
                    class="w-full p-2 border border-gray-300 rounded-md">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md">Search</button>
                <button onclick="openModal('create-item-modal')"
                class="px-4 py-2 bg-blue-600 text-white text-[14px] font-medium rounded-md">
                Tambah Data Item
            </button>
            </div>
        </form>

        <!-- Items Table -->
        <div class="overflow-x-auto rounded-lg shadow-lg shadow-black/15 mb-5">
            <table class="w-full">
                <thead class="bg-white border-b-2 text-center border-gray-200">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">No</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Name</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Description</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Category</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Price</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Stock</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Stock Status</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Status</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr class="bg-white">
                            <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $items->firstItem() + $loop->index }}</td>
                            <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $item->name }}</td>
                            <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $item->description }}</td>
                            <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $item->category->name }}</td>
                            <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $item->stock }}</td>
                            <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">
                                @if ($item->stock < 10)
                                    <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-white bg-yellow-500 rounded">Low Stock</span>
                                @else
                                    <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-white bg-green-500 rounded">Normal</span>
                                @endif
                            </td>
                            <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">
                                @if ($item->status == 'unavailable')
                                    <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-white bg-red-500 rounded">{{ $item->status }}</span>
                                @else
                                    <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-white bg-green-500 rounded">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td class="flex justify-center items-center gap-4 p-3">
                                <button data-modal-target="modal-{{ $item->id }}" data-modal-toggle="modal-{{ $item->id }}"
                                    class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2 text-center"
                                    type="button">
                                    Detail
                                </button>
                                <button data-modal-target="modal-edit-{{ $item->id }}" data-modal-toggle="modal-edit-{{ $item->id }}"
                                    class="text-white bg-yellow-300 hover:bg-yellow-400 font-medium rounded-lg text-sm px-4 py-2 text-center"
                                    type="button">
                                    Edit
                                </button>
                                <form action="{{ route('items.destroy.admins', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this item?');" style="display:inline-block; margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-4 py-2 text-center">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        {{-- Detail Modal --}}
                        @include('admins.modals.detailitems', ['item' => $item])
                        {{-- Edit Modal --}}
                        @include('admins.modals.edititems', ['item' => $item])
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4 flex justify-end">
            {{ $items->links() }}
        </div>
    </div>
@endsection
