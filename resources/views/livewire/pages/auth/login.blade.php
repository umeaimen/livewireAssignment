<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect(
            session('url.intended', RouteServiceProvider::HOME),
            navigate: true
        );
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
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
                        <h4 class="nk-block-title">Sign-In</h4>
                        <div class="nk-block-des">
                            <p>Access the Dashlite panel using your email and passcode.</p>
                        </div>
                    </div>
                </div>
                <form wire:submit="login">
                    <!-- Email Address -->
                    <div class="form-group">
                        <div class="form-label-group">
                           <x-input-label for="email" :value="__('Email')" />
                        </div>
                        <div class="form-control-wrap">
                        <x-text-input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <div class="form-label-group">
                           <x-input-label for="password" :value="__('Password')" />
                           @if (Route::has('password.request'))
                            <a class="link link-primary link-sm"  href="{{ route('password.request') }}" wire:navigate>Forgot Code?</a>
                            @endif
                        </div>
                        <div class="form-control-wrap">
                             <x-text-input wire:model="form.password" id="password"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember" class="inline-flex items-center">
                            <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button >
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
                <div class="form-note-s2 text-center pt-4"> New on our platform? <a href="{{ route('register') }}">Create an account</a>
            </div>
        </div>
    </div>
</div>