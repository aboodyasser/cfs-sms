<x-auth-custom-layout>
    <x-slot name="title">{{ __('Create an Account') }}</x-slot>
    <x-slot name="subtitle">{{ __('Join SmartERP to manage your institution efficiently.') }}</x-slot>

    <form method="POST" action="{{ route('register') }}" class="login-form">
        @csrf
        
        {{-- Name --}}
        <div class="field-group">
            <label for="name" class="field-label">{{ __('Name') }}</label>
            <div class="input-wrap">
                <span class="input-icon">
                    <i class="fas fa-user"></i>
                </span>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="field-input" placeholder="{{ __('Enter your full name') }}">
            </div>
            @error('name')
                <div class="field-error" style="color: #E11D48; font-size: 11px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="field-group mt-4">
            <label for="email" class="field-label">{{ __('Email') }}</label>
            <div class="input-wrap">
                <span class="input-icon">
                    <i class="fas fa-envelope"></i>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="field-input" placeholder="{{ __('Enter your email address') }}">
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
                <input id="password" type="password" name="password" required autocomplete="new-password" class="field-input" placeholder="{{ __('Create a secure password') }}">
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
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="field-input" placeholder="{{ __('Confirm your password') }}">
            </div>
            @error('password_confirmation')
                <div class="field-error" style="color: #E11D48; font-size: 11px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-options" style="display: flex; justify-content: flex-end; align-items: center; margin-top: 15px;">
            <a class="forgot-link" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>

        <button type="submit" class="login-button mt-4">
            {{ __('Register') }}
            <i class="fas fa-user-plus"></i>
        </button>
    </form>
</x-auth-custom-layout>