<x-auth-custom-layout>
    <x-slot name="title">{{ __('Verify Email') }}</x-slot>
    <x-slot name="subtitle">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</x-slot>

    @if (session('status') == 'verification-link-sent')
        <div class="status-box mt-6" style="margin-bottom: 20px; padding: 10px; background: rgba(16, 185, 129, 0.1); color: #059669; border-radius: 8px; font-size: 13px;">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="form-options" style="display: flex; justify-content: space-between; align-items: center; margin-top: 25px;">
        <form method="POST" action="{{ route('verification.send') }}" style="margin:0;">
            @csrf
            <button type="submit" class="login-button" style="margin-top:0; min-height:40px; padding: 0 15px;">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit" class="forgot-link" style="background:transparent; border:none; cursor:pointer;">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-auth-custom-layout>