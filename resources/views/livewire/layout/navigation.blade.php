<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-gray-300 dark:bg-blue-900 border-b border-gray-200 dark:border-gray-700 w-1/6 h-screen sticky top-0">
    <!-- Primary Navigation Menu -->
    <div class="flex justify-between items-center h-14 px-3 sm:px-6 lg:px-3 bg-gray-400 dark:bg-blue-700 shadow-md">
        <!-- Logo -->
        <div class="shrink-0 flex items-center justify-center h-16">
            <a href="{{ route('dashboard') }}" wire:navigate>
                <x-application-logo class="block h-10 w-auto fill-current text-red-500 hover:text-red-600 dark:text-red-400 dark:hover:text-red-300" />
            </a>
        </div>

        <!-- Username -->
        <div
            x-data="{ name: '{{ auth()->user()->name }}' }"
            x-text="name"
            x-on:profile-updated.window="name = $event.detail.name"
            class="text-center text-gray-800 dark:text-gray-100 font-semibold"></div>

        <!-- Hamburger -->
        <div class="-me-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Navigation Sidebar -->
    <div class="flex flex-col p-3 sm:p-6 lg:p-3 bg-gray-300 dark:bg-blue-900 min-h-screen space-y-2">
        <!-- Dashboard -->
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="flex items-center gap-2 text-left p-2 rounded hover:bg-gray-400 dark:hover:bg-blue-800 text-gray-800 dark:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0H7m6 0v8m-6 0h6" />
            </svg>
            {{ __('Dashboard') }}
        </x-nav-link>

        <!-- Post -->
        <x-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.index') || request()->routeIs('admin.posts.create') || request()->routeIs('posts.edit') || request()->routeIs('posts.show')" wire:navigate class="flex items-center gap-2 text-left p-2 rounded hover:bg-gray-400 dark:hover:bg-blue-800 text-gray-800 dark:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16V4a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2H6a2 2 0 01-2-2z" />
            </svg>
            {{ __('Post') }}
        </x-nav-link>

        <!-- Blog -->
        <x-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.index') || request()->routeIs('admin.posts.create') || request()->routeIs('posts.edit') || request()->routeIs('posts.show')" wire:navigate class="flex items-center gap-2 text-left p-2 rounded hover:bg-gray-400 dark:hover:bg-blue-800 text-gray-800 dark:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16V4a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2H6a2 2 0 01-2-2z" />
            </svg>
            {{ __('Blog') }}
        </x-nav-link>

        <!-- Media -->
        <x-nav-link wire:navigate class="flex items-center gap-2 text-left p-2 rounded hover:bg-gray-400 dark:hover:bg-blue-800 text-gray-800 dark:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553 4.553A2.121 2.121 0 0118.12 19H5.88a2.121 2.121 0 01-1.433-3.447L9 10l3 3 3-3z" />
            </svg>
            {{ __('Media') }}
        </x-nav-link>

        <!-- Team -->
        <x-nav-link wire:navigate class="flex items-center gap-2 text-left p-2 rounded hover:bg-gray-400 dark:hover:bg-blue-800 text-gray-800 dark:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-4m-4 6v-2a4 4 0 00-3-3.87M5 20h5v-2a4 4 0 00-5-4M12 4a2 2 0 110 4 2 2 0 010-4z" />
            </svg>
            {{ __('Team') }}
        </x-nav-link>
    </div>


    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>