<nav class="w-full bg-white fixed">
    <div class="py-4 px-6 flex justify-end items-center gap-4 lg:ml-[280px] shadow-md shadow-black/5">
        {{-- <button type="button" class="text-2xl font-bold text-gray-600 md:hidden lg:hidden float-end" onclick="Open()">
            <i class="bi bi-list"></i>
        </button> --}}
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
            class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">Hai, {{ Auth::user()->name }} <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>
        {{-- manggil dropdown menu --}}
        @include('staff.modals.dropdownProfil')
    </div>
</nav>
