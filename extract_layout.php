<?php
$login = file_get_contents('resources/views/auth/login.blade.php');

// We want to replace everything from <h2 class="form-title"> to the end of the form with yielding variables.
// The structure is:
// <h2 class="form-title">...</h2>
// <p class="form-subtitle">...</p>
// </div>
// {{-- Session Status --}} ...
// {{-- Login Form --}} <form ...> ... </form>
// <div class="form-bottom"> ... </div>

// We can just use string splitting.
$topSplit = explode('<h2 class="form-title">', $login);
$bottomSplit = explode('<div class="form-bottom">', $topSplit[1]);

$layoutTop = $topSplit[0] . '<h2 class="form-title">{{ $title ?? \'\' }}</h2>
                        <p class="form-subtitle">{{ $subtitle ?? \'\' }}</p>
                    </div>
                    
                    {{-- Session Status --}}
                    @if (session(\'status\'))
                        <div class="status-box mt-6" style="margin-bottom: 20px; padding: 10px; background: rgba(16, 185, 129, 0.1); color: #059669; border-radius: 8px; font-size: 13px;">
                            {{ session(\'status\') }}
                        </div>
                    @endif

                    {{ $slot }}
                    
                    <div class="form-bottom">';
                    
$layoutBottom = $bottomSplit[1];

$layout = $layoutTop . $layoutBottom;

// Ensure dark mode toggle is available in auth layout
if (strpos($layout, 'toggleTheme') === false) {
    // Add theme toggle script if not present
}

file_put_contents('resources/views/layouts/auth-custom.blade.php', $layout);
echo "auth-custom layout created.\n";

// Now rewrite login.blade.php to use the new layout
$loginContent = <<<EOT
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
                <div class="field-error">{{ \$message }}</div>
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
                <div class="field-error">{{ \$message }}</div>
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
EOT;
file_put_contents('resources/views/auth/login.blade.php', $loginContent);
echo "login.blade.php rewritten.\n";
