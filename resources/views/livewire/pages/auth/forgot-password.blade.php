<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
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
                        <h4 class="nk-block-title">Verify Email</h4>
                        <div class="nk-block-des">
                            <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                        </div>
                    </div>
                </div>
                <form wire:submit="sendPasswordResetLink">
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
