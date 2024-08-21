<!-- Dropdown menu -->
<div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
    <ul class="my-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
        <li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="pl-5">
                @csrf
                <button type="submit" class="text-[15px] text-red-600 bg-transparent border-0 cursor-pointer">
                    Logout
                </button>
            </form>
        </li>
    </ul>
</div>
