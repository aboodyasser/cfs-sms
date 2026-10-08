<x-auth-custom-layout>
    <x-slot name="title">{{ __('Welcome back') }}</x-slot>
    <x-slot name="subtitle">{{ __('Sign in to access your SmartERP management workspace.') }}</x-slot>

    <form method="POST" action="{{ route('login') }}" class="login-form">
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
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field-group mt-4">
            <label for="password" class="field-label">{{ __('Password') }}</label>
            <div class="input-wrap">
                <span class="input-icon">
                    <i class="fas fa-lock"></i>
                </span>
                <input id="password" type="password" name="password" required autocomplete="current-password" class="field-input" placeholder="{{ __('Enter your password') }}">
            </div>
            @error('password')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-options" style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
            <label for="remember_me" class="remember-wrap" style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input id="remember_me" type="checkbox" name="remember" class="remember-checkbox" style="border-radius: 4px; border: 1px solid var(--cfs-border); background: var(--cfs-bg);">
                <span class="remember-text" style="color: var(--cfs-muted); font-size: 13px;">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="forgot-link" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <button type="submit" class="login-button mt-4">
            {{ __('Log in') }}
            <i class="fas fa-arrow-right"></i>
        </button>
    </form>
</x-auth-custom-layout>