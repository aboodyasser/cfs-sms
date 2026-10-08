<x-auth-custom-layout>
    <x-slot name="title">{{ __('Reset Password') }}</x-slot>
    <x-slot name="subtitle">{{ __('Please create a new secure password for your account.') }}</x-slot>

    <form method="POST" action="{{ route('password.store') }}" class="login-form">
        @csrf
        
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Email --}}
        <div class="field-group">
            <label for="email" class="field-label">{{ __('Email') }}</label>
            <div class="input-wrap">
                <span class="input-icon">
                    <i class="fas fa-envelope"></i>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" class="field-input">
            </div>
            @error('email')
                <div class="field-error" style="color: #E11D48; font-size: 11px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="field-group mt-4">
            <label for="password" class="field-label">{{ __('Password') }}</label>
            <div class="input-wrap">
                <span class="input-icon">
                    <i class="fas fa-lock"></i>
                </span>
                <input id="password" type="password" name="password" required autocomplete="new-password" class="field-input" placeholder="{{ __('New password') }}">
            </div>
            @error('password')
                <div class="field-error" style="color: #E11D48; font-size: 11px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="field-group mt-4">
            <label for="password_confirmation" class="field-label">{{ __('Confirm Password') }}</label>
            <div class="input-wrap">
                <span class="input-icon">
                    <i class="fas fa-lock"></i>
                </span>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="field-input" placeholder="{{ __('Confirm new password') }}">
            </div>
            @error('password_confirmation')
                <div class="field-error" style="color: #E11D48; font-size: 11px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="login-button mt-4">
            {{ __('Reset Password') }}
            <i class="fas fa-check"></i>
        </button>
    </form>
</x-auth-custom-layout>