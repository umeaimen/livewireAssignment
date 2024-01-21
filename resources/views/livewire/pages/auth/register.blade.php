<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
        <div class="brand-logo pb-4 text-center">
            <a href="#" class="logo-link">
            <img class="logo-light logo-img logo-img-lg" src="{{ url('/assets/images/logo.png') }}" srcset="{{ url('/assets/images/logo2x.png 2x') }}" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="{{ url('/assets/images/logo-dark.png') }}" srcset="{{ url('/assets/images/logo-dark2x.png 2x') }}" alt="logo-dark">
            </a>
        </div>
        <div class="card">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Register</h4>
                        <div class="nk-block-des">
                            <p>Create New Dashlite Account</p>
                        </div>
                    </div>
                </div>
                <form wire:submit="register">
                    <!-- Name -->
                    <div class="form-group">
                        <x-input-label for="name" :value="__('Name')" />
                        <div class="form-control-wrap">
                           <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <x-input-label for="email" :value="__('Email')" />
                        <div class="form-control-wrap">
                           <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <x-input-label for="password" :value="__('Password')" />
                        <div class="form-control-wrap">
                            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <div class="form-control-wrap">
                            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button >
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
                <div class="form-note-s2 text-center pt-4"> Already have an account? <a href="{{ route('login') }}" wire:navigate><strong>Sign in instead</strong></a>
            </div>
        </div>
    </div>
</div>
