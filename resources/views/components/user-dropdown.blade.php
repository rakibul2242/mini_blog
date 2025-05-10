<div class="sm:flex sm:items-center sm:ps-6 space-x-4 w-auto flex justify-end px-6 h-14 shadow-md bg-purple-600 dark:bg-purple-800">
    <div class="relative">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 dark:text-gray-500">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
            </svg>
        </span>
        <input
            type="text"
            placeholder="Search..."
            class="pl-10 pr-3 py-1.5 border border-gray-200 dark:border-gray-800 rounded-md bg-white dark:bg-gray-800 text-sm text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-150 w-full placeholder:text-gray-400 dark:placeholder:text-gray-500" />
    </div>

    <div class="relative">
        <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none rounded-full p-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full"></span>
        </button>
    </div>

    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
        <button class="inline-flex items-center px-2 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <div class="relative">
                        <svg class="w-6 h-6 rounded-full bg-gray-300 dark:bg-gray-600 text-white" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M12 12c2.7 0 4-1.3 4-4s-1.3-4-4-4-4 1.3-4 4 1.3 4 4 4zm0 2c-3.3 0-6 1.7-6 4v1h12v-1c0-2.3-2.7-4-6-4z" />
                        </svg>
                        <span class="absolute bottom-0 right-0 w-2 h-2 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></span>
                    </div>
                </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile')">
                {{ __('Profile') }}
            </x-dropdown-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</div>