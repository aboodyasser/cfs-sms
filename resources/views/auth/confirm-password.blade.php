<x-auth-custom-layout>
    <x-slot name="title">{{ __('Secure Area') }}</x-slot>
    <x-slot name="subtitle">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</x-slot>

    <form method="POST" action="{{ route('password.confirm') }}" class="login-form">
        @csrf

        {{-- Password --}}
        <div class="field-group mt-4">
            <label for="password" class="field-label">{{ __('Password') }}</label>
            <div class="input-wrap">
                <span class="input-icon">
                    <i class="fas fa-lock"></i>
                </span>
                <input id="password" type="password" name="password" required autocomplete="current-password" class="field-input" placeholder="{{ __('Enter your password') }}">
            </div>
            @error('password')
                <div class="field-error" style="color: #E11D48; font-size: 11px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="login-button mt-4">
            {{ __('Confirm') }}
            <i class="fas fa-shield-check"></i>
        </button>
    </form>
</x-auth-custom-layout>