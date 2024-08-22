@extends('staff.pages.main')

@include('staff.modals.createitem')

@section('title', 'Items')

@section('content')
    <div class="w-full p-5 flex flex-col gap-4">
        <h2 class="text-2xl font-semibold mb-2">Items</h2>
        <div class="flex justify-end mb-4">
            <button onclick="openModal('create-item-modal-staff')"
                class="px-4 py-2 bg-blue-600 text-white text-[14px] font-medium rounded-md">
                Tambah Data Item
            </button>
        </div>
        <div class="overflow-x-auto rounded-lg shadow-lg shadow-black/15 mb-5">
            <table class="w-full">
                <thead class="bg-white border-b-2 border-gray-200">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">No</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Name</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Description</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Category</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Price</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Stock</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Status</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr class="bg-white">
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $item->name }}</td>
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{$item->description}}</td>
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{$item->category->name}}</td>
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">Rp.{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $item->stock }}</td>
                        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">
                            @if ($item->status == 'unavailable')
                            <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-white bg-red-500 rounded">{{$item->status}}</span>
                            @else
                            <span class="p-1.5 text-xs font-medium uppercase tracking-wider text-white bg-green-500 rounded">{{$item->status}}</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex justify-center gap-2">
                                <div class="">
                                    <button data-modal-target="modal-{{ $item->id }}" data-modal-toggle="modal-{{ $item->id }}" class="block text-white bg-blue-700 hover:p-2.5 hover:bg-blue-800 font-medium rounded-lg text-md p-2.5 text-center" type="button">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <div class="">
                                    <button data-modal-target="modal-edit-{{ $item->id }}" data-modal-toggle="modal-edit-{{ $item->id }}" class="block text-white bg-green-500 hover:p-2.5 hover:bg-green-600 font-medium rounded-lg text-md p-2.5 text-center" type="button">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr> 
                    {{-- Detail Modal --}}
                    @include('staff.modals.detailitems', ['item' => $item])
                    {{-- Edit Modal --}}
                    @include('staff.modals.edititems', ['item' => $item])
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection
