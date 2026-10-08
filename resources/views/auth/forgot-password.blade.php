<x-auth-custom-layout>
    <x-slot name="title">{{ __('Forgot Password') }}</x-slot>
    <x-slot name="subtitle">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</x-slot>

    <form method="POST" action="{{ route('password.email') }}" class="login-form">
        @csrf
        
        <div class="field-group">
            <label for="email" class="field-label">{{ __('Email') }}</label>
            <div class="input-wrap">
                <span class="input-icon">
                    <i class="fas fa-envelope"></i>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="field-input" placeholder="{{ __('Enter your email address') }}">
            </div>
            @error('email')
                <div class="field-error" style="color: #E11D48; font-size: 11px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-options" style="display: flex; justify-content: flex-start; align-items: center; margin-top: 15px;">
            <a class="forgot-link" href="{{ route('login') }}">
                <i class="fas fa-arrow-left"></i> {{ __('Back to login') }}
            </a>
        </div>

        <button type="submit" class="login-button mt-4">
            {{ __('Email Password Reset Link') }}
            <i class="fas fa-paper-plane"></i>
        </button>
    </form>
</x-auth-custom-layout>