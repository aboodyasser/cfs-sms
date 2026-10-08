<!DOCTYPE html>

<html
    lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"
    dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>"
>
<head><link rel="icon" type="image/jpeg" href="<?php echo e(asset('favicon.jpg')); ?>?v=2">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


<title>
    <?php echo $__env->yieldContent('title', config('app.name', 'SmartERP')); ?>
</title>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet"
>


<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>


<?php echo app('Illuminate\Foundation\Vite')([
    'resources/css/app.css',
    'resources/js/app.js'
]); ?>

<?php echo $__env->yieldPushContent('styles'); ?>

<style>
    :root {
        --cfs-bg: #F8FAFC;
        --cfs-bg-2: #F1F5F9;
        --cfs-card: #FFFFFF;

        --cfs-primary: #0EA5E9;
        --cfs-primary-dark: #0369A1;
        --cfs-secondary: #D946EF;
        --cfs-tertiary: #F59E0B;

        --cfs-text: #0F172A;
        --cfs-text-2: #475569;
        --cfs-text-3: #94A3B8;

        --cfs-line: rgba(15, 23, 42, .08);
        --cfs-line-strong: rgba(15, 23, 42, .14);

        --cfs-radius-sm: .6rem;
        --cfs-radius-md: .9rem;
        --cfs-radius-lg: 1.25rem;
        --cfs-radius-xl: 1.75rem;

        --cfs-ease: cubic-bezier(.16, 1, .3, 1);
    }

    html.dark {
        --cfs-bg: #0F172A;
        --cfs-bg-2: #1E293B;
        --cfs-card: #1E293B;
        --cfs-card-hover: #334155;
        --cfs-glass: rgba(255, 255, 255, 0.035);
        --cfs-primary: #38BDF8;
        --cfs-primary-dark: #0284C7;
        --cfs-secondary: #E879F9;
        --cfs-tertiary: #FBBF24;
        --cfs-text: #F8FAFC;
        --cfs-text-1: #F8FAFC;
        --cfs-text-2: #CBD5E1;
        --cfs-text-3: #94A3B8;
        --cfs-line: rgba(255, 255, 255, 0.1);
        --cfs-line-strong: rgba(255, 255, 255, 0.18);
    }


    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
        overflow-x: hidden;
    }

    body {
        margin: 0;
        font-family: 'Outfit', 'IBM Plex Sans Arabic', sans-serif;
        background: var(--cfs-bg);
        color: var(--cfs-text);
        line-height: 1.6;
        overflow-x: hidden;
    }

    [dir="rtl"] body {
        font-family: 'IBM Plex Sans Arabic', 'Outfit', sans-serif;
    }

    /* ========================================
       Background
    ======================================== */

    .cfs-page-bg {
        position: fixed;
        inset: 0;
        z-index: -2;
        pointer-events: none;

        background:
            linear-gradient(
                var(--cfs-line) 1px,
                transparent 1px
            ),
            linear-gradient(
                90deg,
                var(--cfs-line) 1px,
                transparent 1px
            );

        background-size: 64px 64px;

        mask-image: radial-gradient(
            ellipse 80% 60% at 50% 0%,
            black 0%,
            transparent 80%
        );

        opacity: .55;
    }

    .cfs-orb {
        position: fixed;
        z-index: -1;
        pointer-events: none;
        border-radius: 50%;
        filter: blur(80px);
    }

    .cfs-orb-1 {
        top: -180px;
        left: -180px;
        width: 480px;
        height: 480px;

        background: radial-gradient(
            circle,
            rgba(14, 165, 233, .10),
            transparent 70%
        );
    }

    .cfs-orb-2 {
        top: 15%;
        right: -200px;
        width: 450px;
        height: 450px;

        background: radial-gradient(
            circle,
            rgba(217, 70, 239, .07),
            transparent 70%
        );
    }

    /* ========================================
       Main
    ======================================== */

    .cfs-main {
        position: relative;
        z-index: 1;

        min-height: calc(100vh - 90px);
        padding: 2rem 1.5rem 3rem;
    }

    .cfs-container {
        position: relative;
        z-index: 2;

        width: 100%;
        max-width: 1360px;
        margin-inline: auto;
    }

    /* ========================================
       Page Heading
    ======================================== */

    .cfs-page-heading {
        margin-bottom: 2rem;
    }

    .cfs-page-heading-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .cfs-page-title {
        margin: 0;
        font-size: 1.65rem;
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -.025em;
        color: var(--cfs-text);
    }

    .cfs-page-subtitle {
        margin: .45rem 0 0;
        color: var(--cfs-text-2);
        font-size: .9rem;
    }

    /* ========================================
       Content Card
    ======================================== */

    .cfs-content-card {
        background: var(--cfs-card);
        border: 1px solid var(--cfs-line);
        border-radius: var(--cfs-radius-xl);

        box-shadow:
            0 12px 40px rgba(15, 23, 42, .055);

        backdrop-filter: blur(16px);
    }

    /* ========================================
       Responsive
    ======================================== */

    @media (max-width: 768px) {
        .cfs-main {
            padding: 1.25rem 1rem 2rem;
        }

        .cfs-page-title {
            font-size: 1.4rem;
        }

        .cfs-page-heading {
            margin-bottom: 1.25rem;
        }
    }
</style>


<script>
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
    function toggleTheme() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        } else {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        }
    }
</script>
</head>

<body>



<div class="cfs-page-bg"></div>

<div class="cfs-orb cfs-orb-1"></div>
<div class="cfs-orb cfs-orb-2"></div>

<div class="min-h-screen">

    
    <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <main class="cfs-main">

        <div class="cfs-container">

            
            <?php if (! empty(trim($__env->yieldContent('header')))): ?>
                <div class="cfs-page-heading">
                    <?php echo $__env->yieldContent('header'); ?>
                </div>
            <?php endif; ?>

            

            <?php if (! empty(trim($__env->yieldContent('content')))): ?>

                <?php echo $__env->yieldContent('content'); ?>

            <?php else: ?>

                <?php echo e($slot ?? ''); ?>


            <?php endif; ?>

        </div>

    </main>

</div>

<?php echo $__env->yieldPushContent('scripts'); ?>


    <?php echo $__env->make('partials.toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\cfs-sms\resources\views/layouts/app.blade.php ENDPATH**/ ?>