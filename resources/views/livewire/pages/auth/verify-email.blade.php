<?php

use App\Livewire\Actions\Logout;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirect(
                session('url.intended', RouteServiceProvider::HOME),
                navigate: true
            );

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
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
                            <p> {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>
                        </div>
                        <div class="nk-block-des">
                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <x-primary-button wire:click="sendVerification">
                        {{ __('Resend Verification Email') }}
                    </x-primary-button>

                    <button wire:click="logout" type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" style="display: none;">
                        {{ __('Log Out') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
