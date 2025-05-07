<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">
        {{ __('Create an Account') }}
    </h2>

    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="dark:text-gray-300" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full text-sm dark:bg-gray-800 dark:text-white dark:border-gray-600" type="text" name="name" required autofocus autocomplete="name" placeholder="Enter your name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="dark:text-gray-300" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full text-sm dark:bg-gray-800 dark:text-white dark:border-gray-600" type="email" name="email" required autocomplete="username" placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="dark:text-gray-300" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full text-sm dark:bg-gray-800 dark:text-white dark:border-gray-600" type="password" name="password" required autocomplete="new-password" placeholder="Create a password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="dark:text-gray-300" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full text-sm dark:bg-gray-800 dark:text-white dark:border-gray-600" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-center mt-6">
            <x-primary-button class="dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:text-white">
                {{ __('Sign up') }}
            </x-primary-button>
        </div>

        <!-- Login link -->
        <div class="flex items-center justify-center text-sm mt-4 text-gray-600 dark:text-gray-400">
            {{ __('Already have an account?') }}
            <a class="ml-1 text-blue-600 dark:text-blue-400 hover:underline" href="{{ route('login') }}" wire:navigate>
                {{ __('Login now') }}
            </a>
        </div>
    </form>
</div>
