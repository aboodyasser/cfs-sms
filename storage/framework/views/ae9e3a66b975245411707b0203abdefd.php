<?php
    $isRtl = app()->getLocale() === 'ar';
    $dashboardActive = request()->routeIs('dashboard');
    $contractsActive = request()->routeIs('admin.contracts.*');
    $contractCreateActive = request()->routeIs('admin.contracts.create');
    $contractIndexActive = request()->routeIs('admin.contracts.index');
    $reportsActive = request()->routeIs('admin.financial-reports.*');
    $usersActive = request()->routeIs('admin.users.*');
    $rolesActive = request()->routeIs('admin.roles.*');
    $userManagementActive = $usersActive || $rolesActive;
    $systemMapActive = request()->routeIs('admin.system.map');
?>

<div
    x-data="{
        open: false,
        contractsOpen: <?php echo e($contractsActive ? 'true' : 'false'); ?>,
        financialReportsOpen: <?php echo e($reportsActive ? 'true' : 'false'); ?>,
        userManagementOpen: <?php echo e($userManagementActive ? 'true' : 'false'); ?>,
        scrolled: false
    }"
    x-init="
        window.addEventListener('scroll', () => {
            scrolled = window.scrollY > 10
        })
    "
    class="cfs-nav-wrap"
>
    <nav
        :class="{
            'cfs-nav': true,
            'cfs-nav-scrolled': scrolled,
            'cfs-nav-open': open
        }"
    >
        <div class="cfs-nav-inner">
            
            <a href="<?php echo e(route('dashboard')); ?>" class="cfs-brand">
                <div class="cfs-brand-icon" style="background: linear-gradient(135deg, var(--cfs-primary), var(--cfs-secondary)); color: white; box-shadow: 0 4px 15px rgba(14,165,233,0.3);">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="cfs-brand-text">
                    <span class="cfs-brand-name">
                        <?php echo e(config('app.name', 'SmartERP')); ?>

                    </span>
                    <span class="cfs-brand-tagline">
                        <?php echo e(__('Smart Management System')); ?>

                    </span>
                </div>
            </a>

            
            <div class="cfs-desktop-nav">
                
                <a
                    href="<?php echo e(route('dashboard')); ?>"
                    class="cfs-nav-link <?php echo e($dashboardActive ? 'active' : ''); ?>"
                >
                    <i class="fas fa-table-cells-large"></i>
                    <span><?php echo e(__('Dashboard')); ?></span>
                </a>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_contracts')): ?>
                    <div
                        class="cfs-nav-dropdown"
                        @click.outside="contractsOpen = false"
                    >
                        <button
                            type="button"
                            @click="contractsOpen = !contractsOpen"
                            class="cfs-nav-link cfs-nav-dropdown-trigger <?php echo e($contractsActive ? 'active' : ''); ?>"
                            :aria-expanded="contractsOpen"
                        >
                            <i class="fas fa-handshake"></i>
                            <span><?php echo e(__('Contracts')); ?></span>
                            <i
                                class="fas fa-chevron-down cfs-chevron"
                                :class="{ 'rotate-180': contractsOpen }"
                            ></i>
                        </button>

                        <div
                            x-show="contractsOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                            class="cfs-dropdown cfs-contracts-dropdown"
                            style="display: none;"
                        >
                            <div class="cfs-dropdown-header">
                                <span class="cfs-dropdown-kicker">
                                    <?php echo e(__('Contracts')); ?>

                                </span>
                                <span class="cfs-dropdown-title">
                                    <?php echo e(__('Contract Management')); ?>

                                </span>
                            </div>
                            <div class="cfs-dropdown-list">
                                <a
                                    href="<?php echo e(route('admin.contracts.index')); ?>"
                                    class="cfs-dropdown-link <?php echo e($contractIndexActive ? 'active' : ''); ?>"
                                >
                                    <span class="cfs-dropdown-icon">
                                        <i class="fas fa-box-archive"></i>
                                    </span>
                                    <span class="cfs-dropdown-content">
                                        <strong><?php echo e(__('All Contracts')); ?></strong>
                                        <small><?php echo e(__('View and manage contracts')); ?></small>
                                    </span>
                                    <?php if($contractIndexActive): ?>
                                        <i class="fas fa-check cfs-dropdown-check"></i>
                                    <?php else: ?>
                                        <i class="fas fa-arrow-right cfs-dropdown-arrow"></i>
                                    <?php endif; ?>
                                </a>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_contract')): ?>
                                    <a
                                        href="<?php echo e(route('admin.contracts.create')); ?>"
                                        class="cfs-dropdown-link cfs-dropdown-create <?php echo e($contractCreateActive ? 'active' : ''); ?>"
                                    >
                                        <span class="cfs-dropdown-icon create-icon">
                                            <i class="fas fa-circle-plus"></i>
                                        </span>
                                        <span class="cfs-dropdown-content">
                                            <strong><?php echo e(__('New Contract')); ?></strong>
                                            <small><?php echo e(__('Create a new contract')); ?></small>
                                        </span>
                                        <?php if($contractCreateActive): ?>
                                            <i class="fas fa-check cfs-dropdown-check"></i>
                                        <?php else: ?>
                                            <i class="fas fa-arrow-right cfs-dropdown-arrow"></i>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <div class="cfs-dropdown-footer">
                                <i class="fas fa-shield-halved"></i>
                                <span><?php echo e(__('Manage contracts securely and efficiently.')); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_reports')): ?>
                    <div
                        class="cfs-nav-dropdown"
                        @click.outside="financialReportsOpen = false"
                    >
                        <button
                            type="button"
                            @click="financialReportsOpen = !financialReportsOpen"
                            class="cfs-nav-link cfs-nav-dropdown-trigger <?php echo e($reportsActive ? 'active' : ''); ?>"
                            :aria-expanded="financialReportsOpen"
                        >
                            <i class="fas fa-vault"></i>
                            <span><?php echo e(__('Financial Reports')); ?></span>
                            <i
                                class="fas fa-chevron-down cfs-chevron"
                                :class="{ 'rotate-180': financialReportsOpen }"
                            ></i>
                        </button>

                        <div
                            x-show="financialReportsOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                            class="cfs-dropdown"
                            style="display: none;"
                        >
                            <div class="cfs-dropdown-header">
                                <span class="cfs-dropdown-kicker"><?php echo e(__('Financial Reports')); ?></span>
                                <span class="cfs-dropdown-title"><?php echo e(__('Reports Center')); ?></span>
                            </div>

                            <?php
                                $reportLinks = [
                                    'admin.financial-reports.index' => ['Overview', 'fa-vault'],
                                    'admin.financial-reports.summary' => ['Financial Summary', 'fa-scale-balanced'],
                                    'admin.financial-reports.income' => ['Income Report', 'fa-hand-holding-dollar'],
                                    'admin.financial-reports.expenses' => ['Expenses Report', 'fa-credit-card'],
                                    'admin.financial-reports.budgets' => ['Budgets Report', 'fa-piggy-bank'],
                                    'admin.financial-reports.invoices' => ['Invoices Report', 'fa-file-invoice'],
                                    'admin.financial-reports.payments' => ['Payments Report', 'fa-credit-card'],
                                    'admin.financial-reports.receipts' => ['Receipts Report', 'fa-stamp'],
                                ];
                            ?>

                            <div class="cfs-dropdown-list">
                                <?php $__currentLoopData = $reportLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routeName => [$label, $icon]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a
                                        href="<?php echo e(route($routeName)); ?>"
                                        class="cfs-dropdown-link <?php echo e(request()->routeIs($routeName) ? 'active' : ''); ?>"
                                    >
                                        <span class="cfs-dropdown-icon">
                                            <i class="fas <?php echo e($icon); ?>"></i>
                                        </span>
                                        <span class="cfs-dropdown-content">
                                            <strong><?php echo e(__($label)); ?></strong>
                                        </span>
                                        <?php if(request()->routeIs($routeName)): ?>
                                            <i class="fas fa-check cfs-dropdown-check"></i>
                                        <?php endif; ?>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['view_users', 'view_roles'])): ?>
                    <div
                        class="cfs-nav-dropdown"
                        @click.outside="userManagementOpen = false"
                    >
                        <button
                            type="button"
                            @click="userManagementOpen = !userManagementOpen"
                            class="cfs-nav-link cfs-nav-dropdown-trigger <?php echo e($userManagementActive ? 'active' : ''); ?>"
                            :aria-expanded="userManagementOpen"
                        >
                            <i class="fas fa-id-card-clip"></i>
                            <span><?php echo e(__('Users & Roles')); ?></span>
                            <i
                                class="fas fa-chevron-down cfs-chevron"
                                :class="{ 'rotate-180': userManagementOpen }"
                            ></i>
                        </button>

                        <div
                            x-show="userManagementOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                            class="cfs-dropdown"
                            style="display: none;"
                        >
                            <div class="cfs-dropdown-header">
                                <span class="cfs-dropdown-kicker"><?php echo e(__('Administration')); ?></span>
                                <span class="cfs-dropdown-title"><?php echo e(__('Access Control')); ?></span>
                            </div>
                            <div class="cfs-dropdown-list">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_users')): ?>
                                    <a
                                        href="<?php echo e(route('admin.users.index')); ?>"
                                        class="cfs-dropdown-link <?php echo e($usersActive ? 'active' : ''); ?>"
                                    >
                                        <span class="cfs-dropdown-icon">
                                            <i class="fas fa-user-group"></i>
                                        </span>
                                        <span class="cfs-dropdown-content">
                                            <strong><?php echo e(__('Users')); ?></strong>
                                            <small><?php echo e(__('Manage system users')); ?></small>
                                        </span>
                                        <?php if($usersActive): ?>
                                            <i class="fas fa-check cfs-dropdown-check"></i>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_roles')): ?>
                                    <a
                                        href="<?php echo e(route('admin.roles.index')); ?>"
                                        class="cfs-dropdown-link <?php echo e($rolesActive ? 'active' : ''); ?>"
                                    >
                                        <span class="cfs-dropdown-icon">
                                            <i class="fas fa-user-lock"></i>
                                        </span>
                                        <span class="cfs-dropdown-content">
                                            <strong><?php echo e(__('Roles & Permissions')); ?></strong>
                                            <small><?php echo e(__('Manage roles and access')); ?></small>
                                        </span>
                                        <?php if($rolesActive): ?>
                                            <i class="fas fa-check cfs-dropdown-check"></i>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                
                <a
                    href="<?php echo e(route('admin.system.map')); ?>"
                    class="cfs-nav-link <?php echo e($systemMapActive ? 'active' : ''); ?>"
                >
                    <i class="fas fa-network-wired"></i>
                    <span><?php echo e(__('System Quick Map')); ?></span>
                </a>
            </div>

            
            <div class="cfs-nav-actions">
                
                <button type="button" onclick="toggleTheme()" class="cfs-theme-toggle-desktop relative inline-flex items-center p-2 rounded-full text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:bg-slate-700 hover:text-slate-700 transition" title="<?php echo e(__('Toggle Dark Mode')); ?>">
                    <i class="fas fa-circle-half-stroke text-lg" style="color: var(--cfs-text-3);"></i>
                </button>
                
                <div class="cfs-notifications-wrapper">
                    <?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'right','width' => '80']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'right','width' => '80']); ?>
                         <?php $__env->slot('trigger', null, []); ?> 
                            <button type="button" class="relative inline-flex items-center p-2 rounded-full text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:bg-slate-700 hover:text-slate-700 transition">
                                <i class="fas fa-bell text-lg"></i>
                                <?php if(Auth::user()->unreadNotifications->count() > 0): ?>
                                    <span class="absolute top-1 right-1 inline-flex items-center justify-center h-4 w-4 text-[10px] font-bold text-white bg-rose-500 rounded-full">
                                        <?php echo e(Auth::user()->unreadNotifications->count()); ?>

                                    </span>
                                <?php endif; ?>
                            </button>
                         <?php $__env->endSlot(); ?>
                         <?php $__env->slot('content', null, []); ?> 
                            <div class="p-3 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400"><?php echo e(__('Notifications')); ?></span>
                                <?php if(Auth::user()->unreadNotifications->count() > 0): ?>
                                    <form method="POST" action="<?php echo e(route('notifications.read-all')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="text-xs text-sky-600 hover:underline font-medium"><?php echo e(__('Mark all read')); ?></button>
                                    </form>
                                <?php endif; ?>
                            </div>
                            <div class="max-h-64 overflow-y-auto divide-y divide-slate-50">
                                <?php $__empty_1 = true; $__currentLoopData = Auth::user()->notifications()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="p-3 <?php echo e($notif->unread() ? 'bg-sky-50/50' : ''); ?> text-xs">
                                        <strong class="block font-semibold text-slate-800 dark:text-slate-200"><?php echo e($notif->data['title'] ?? 'Notification'); ?></strong>
                                        <p class="text-slate-500 dark:text-slate-400 mt-0.5"><?php echo e($notif->data['message'] ?? ''); ?></p>
                                        <span class="text-[10px] text-slate-400 mt-1 block"><?php echo e($notif->created_at->diffForHumans()); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="p-4 text-center text-xs text-slate-400">
                                        <?php echo e(__('No notifications yet')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                         <?php $__env->endSlot(); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
                </div>

                
                <div class="cfs-language">
                    <i class="fas fa-globe" style="color: var(--cfs-text-3); font-size: 13px; margin: 0 4px;"></i>
                    <a href="<?php echo e(route('lang.switch', 'ar')); ?>" class="<?php echo e($isRtl ? 'active' : ''); ?>" style="font-family: 'IBM Plex Sans Arabic', sans-serif;">عربي</a>
                    <span>/</span>
                    <a href="<?php echo e(route('lang.switch', 'en')); ?>" class="<?php echo e(!$isRtl ? 'active' : ''); ?>">English</a>
                </div>

                
                <div class="cfs-user-wrapper">
                    <?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'right','width' => '48']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'right','width' => '48']); ?>
                         <?php $__env->slot('trigger', null, []); ?> 
                            <button type="button" class="cfs-user-button">
                                <span class="cfs-user-avatar">
                                    <?php echo e(mb_substr(Auth::user()->name, 0, 1)); ?>

                                </span>
                                <span class="cfs-user-name">
                                    <?php echo e(Auth::user()->name); ?>

                                </span>
                                <i class="fas fa-chevron-down cfs-user-chevron"></i>
                            </button>
                         <?php $__env->endSlot(); ?>
                         <?php $__env->slot('content', null, []); ?> 
                            <div class="cfs-account-header">
                                <div class="cfs-account-avatar">
                                    <?php echo e(mb_substr(Auth::user()->name, 0, 1)); ?>

                                </div>
                                <div>
                                    <strong><?php echo e(Auth::user()->name); ?></strong>
                                    <span><?php echo e(Auth::user()->email); ?></span>
                                </div>
                            </div>
                            <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('profile.edit')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('profile.edit'))]); ?>
                                <i class="fas fa-user-gear me-2"></i>
                                <?php echo e(__('Profile')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('logout'),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('logout')),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();']); ?>
                                    <i class="fas fa-arrow-right-from-bracket me-2"></i>
                                    <?php echo e(__('Log Out')); ?>

                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                            </form>
                         <?php $__env->endSlot(); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
                </div>

                
                <button
                    type="button"
                    @click="open = !open"
                    class="cfs-mobile-toggle"
                    aria-label="Toggle navigation"
                >
                    <i class="fas" :class="open ? 'fa-xmark' : 'fa-bars'"></i>
                </button>
            </div>
        </div>

        
        <div
            x-show="open"
            x-transition
            class="cfs-mobile-menu"
            style="display: none;"
        >
            <div class="cfs-mobile-links">
                <a
                    href="<?php echo e(route('dashboard')); ?>"
                    class="cfs-mobile-link <?php echo e($dashboardActive ? 'active' : ''); ?>"
                >
                    <i class="fas fa-table-cells-large"></i>
                    <span><?php echo e(__('Dashboard')); ?></span>
                </a>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_contracts')): ?>
                    <div class="cfs-mobile-section cfs-mobile-contracts">
                        <div class="cfs-mobile-section-title">
                            <span class="cfs-mobile-section-title-main">
                                <i class="fas fa-handshake"></i>
                                <?php echo e(__('Contracts')); ?>

                            </span>
                        </div>
                        <a
                            href="<?php echo e(route('admin.contracts.index')); ?>"
                            class="cfs-mobile-report <?php echo e($contractIndexActive ? 'active' : ''); ?>"
                        >
                            <span class="cfs-mobile-report-icon"><i class="fas fa-box-archive"></i></span>
                            <span class="cfs-mobile-report-content">
                                <strong><?php echo e(__('All Contracts')); ?></strong>
                            </span>
                        </a>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_contract')): ?>
                            <a
                                href="<?php echo e(route('admin.contracts.create')); ?>"
                                class="cfs-mobile-report <?php echo e($contractCreateActive ? 'active' : ''); ?>"
                            >
                                <span class="cfs-mobile-report-icon create-icon"><i class="fas fa-circle-plus"></i></span>
                                <span class="cfs-mobile-report-content">
                                    <strong><?php echo e(__('New Contract')); ?></strong>
                                </span>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_reports')): ?>
                    <div class="cfs-mobile-section">
                        <div class="cfs-mobile-section-title">
                            <span class="cfs-mobile-section-title-main">
                                <i class="fas fa-vault"></i>
                                <?php echo e(__('Financial Reports')); ?>

                            </span>
                        </div>
                        <?php $__currentLoopData = $reportLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routeName => [$label, $icon]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a
                                href="<?php echo e(route($routeName)); ?>"
                                class="cfs-mobile-report <?php echo e(request()->routeIs($routeName) ? 'active' : ''); ?>"
                            >
                                <span class="cfs-mobile-report-icon"><i class="fas <?php echo e($icon); ?>"></i></span>
                                <span class="cfs-mobile-report-content">
                                    <strong><?php echo e(__($label)); ?></strong>
                                </span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['view_users', 'view_roles'])): ?>
                    <div class="cfs-mobile-section">
                        <div class="cfs-mobile-section-title">
                            <span class="cfs-mobile-section-title-main">
                                <i class="fas fa-id-card-clip"></i>
                                <?php echo e(__('Users & Roles')); ?>

                            </span>
                        </div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_users')): ?>
                            <a
                                href="<?php echo e(route('admin.users.index')); ?>"
                                class="cfs-mobile-report <?php echo e($usersActive ? 'active' : ''); ?>"
                            >
                                <span class="cfs-mobile-report-icon"><i class="fas fa-user-group"></i></span>
                                <span class="cfs-mobile-report-content">
                                    <strong><?php echo e(__('Users')); ?></strong>
                                </span>
                            </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_roles')): ?>
                            <a
                                href="<?php echo e(route('admin.roles.index')); ?>"
                                class="cfs-mobile-report <?php echo e($rolesActive ? 'active' : ''); ?>"
                            >
                                <span class="cfs-mobile-report-icon"><i class="fas fa-user-lock"></i></span>
                                <span class="cfs-mobile-report-content">
                                    <strong><?php echo e(__('Roles & Permissions')); ?></strong>
                                </span>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                
                <div class="cfs-mobile-section">
                    <a
                        href="<?php echo e(route('admin.system.map')); ?>"
                        class="cfs-mobile-link <?php echo e($systemMapActive ? 'active' : ''); ?>"
                    >
                        <i class="fas fa-network-wired"></i>
                        <span><?php echo e(__('System Quick Map')); ?></span>
                    </a>
                </div>
            </div>

            
            <div class="cfs-mobile-account">
                <div class="cfs-mobile-settings" style="display: flex; align-items: center; justify-content: space-between; padding: 0.5rem 0.75rem; border-bottom: 1px solid var(--cfs-line); margin-bottom: 0.5rem;">
                    <div class="cfs-language">
                        <i class="fas fa-globe" style="color: var(--cfs-text-3); font-size: 13px; margin: 0 4px;"></i>
                        <a href="<?php echo e(route('lang.switch', 'ar')); ?>" class="<?php echo e($isRtl ? 'active' : ''); ?>" style="font-family: 'IBM Plex Sans Arabic', sans-serif;">عربي</a>
                        <span>/</span>
                        <a href="<?php echo e(route('lang.switch', 'en')); ?>" class="<?php echo e(!$isRtl ? 'active' : ''); ?>">English</a>
                    </div>
                    <button type="button" onclick="toggleTheme()" class="relative inline-flex items-center p-2 rounded-full text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:bg-slate-700 hover:text-slate-700 transition" title="<?php echo e(__('Toggle Dark Mode')); ?>">
                        <i class="fas fa-circle-half-stroke text-lg" style="color: var(--cfs-text-3);"></i>
                    </button>
                </div>
                <div class="cfs-mobile-account-user">
                    <span class="cfs-user-avatar">
                        <?php echo e(mb_substr(Auth::user()->name, 0, 1)); ?>

                    </span>
                    <div>
                        <strong><?php echo e(Auth::user()->name); ?></strong>
                        <span><?php echo e(Auth::user()->email); ?></span>
                    </div>
                </div>
                <a href="<?php echo e(route('profile.edit')); ?>" class="cfs-mobile-link">
                    <i class="fas fa-user-gear"></i>
                    <span><?php echo e(__('Profile')); ?></span>
                </a>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <a
                        href="<?php echo e(route('logout')); ?>"
                        class="cfs-mobile-link"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        <i class="fas fa-arrow-right-from-bracket"></i>
                        <span><?php echo e(__('Log Out')); ?></span>
                    </a>
                </form>
            </div>
        </div>
    </nav>
</div>

<style>

    /* =========================================================
       CFS NAVIGATION
       ========================================================= */

    .cfs-nav-wrap {
        position: sticky;
        top: 0;
        z-index: 50;
        padding: 1rem 1.25rem 0;
    }

    .cfs-nav {
        width: 100%;
        max-width: 1360px;
        margin-inline: auto;
        background: var(--cfs-glass, rgba(255, 255, 255, .72));
        border: 1px solid var(--cfs-line);
        border-radius: 999px;
        backdrop-filter: blur(20px) saturate(160%);
        -webkit-backdrop-filter: blur(20px) saturate(160%);
        box-shadow: 0 5px 25px rgba(15, 23, 42, .05);
        transition: all .35s var(--cfs-ease);
    }

    .cfs-nav-scrolled {
        background: var(--cfs-card);
        border-color: var(--cfs-line-strong);
        box-shadow: 0 12px 35px rgba(15, 23, 42, .09);
    }

    .cfs-nav.cfs-nav-open {
        border-radius: 1.5rem !important;
        background: var(--cfs-card) !important;
        box-shadow: 0 20px 50px rgba(15, 23, 42, .12) !important;
    }


    /* =========================================================
       INNER
       ========================================================= */

    .cfs-nav-inner {
        min-height: 70px;
        padding: .7rem .85rem .7rem 1.1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    [dir="rtl"] .cfs-nav-inner {
        padding: .7rem 1.1rem .7rem .85rem;
    }


    /* =========================================================
       BRAND
       ========================================================= */

    .cfs-brand {
        display: flex;
        align-items: center;
        gap: .7rem;
        text-decoration: none;
        color: var(--cfs-text);
        flex-shrink: 0;
    }

    .cfs-brand-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: .85rem;
        color: white;
        font-size: 1.15rem;
        background: linear-gradient(
            135deg,
            var(--cfs-primary),
            var(--cfs-primary-dark)
        );
        box-shadow: 0 6px 18px rgba(14, 165, 233, .28);
        transition: transform .35s var(--cfs-ease);
    }

    .cfs-brand:hover .cfs-brand-icon {
        transform: rotate(-6deg) scale(1.05);
    }

    .cfs-brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .cfs-brand-name {
        font-size: .98rem;
        font-weight: 800;
        letter-spacing: -.015em;
    }

    .cfs-brand-tagline {
        margin-top: .18rem;
        color: var(--cfs-text-3);
        font-size: .62rem;
    }


    /* =========================================================
       DESKTOP NAV
       ========================================================= */

    .cfs-desktop-nav {
        display: flex;
        align-items: center;
        gap: .25rem;
        margin-inline: auto;
    }

    .cfs-nav-link {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .62rem .85rem;
        border: 0;
        border-radius: 999px;
        background: transparent;
        color: var(--cfs-text-2);
        font-family: inherit;
        font-size: .79rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all .25s ease;
        white-space: nowrap;
    }

    .cfs-nav-link i {
        font-size: .78rem;
    }

    .cfs-nav-link:hover {
        color: var(--cfs-text);
        background: var(--cfs-bg-2);
    }

    .cfs-nav-link.active {
        color: var(--cfs-primary-dark);
        background: rgba(14, 165, 233, .09);
    }

    .cfs-nav-link.active i {
        color: var(--cfs-primary);
    }


    /* =========================================================
       DROPDOWNS
       ========================================================= */

    .cfs-nav-dropdown {
        position: relative;
    }

    .cfs-chevron {
        margin-inline-start: .1rem;
        font-size: .65rem !important;
        transition: transform .25s ease;
    }

    .cfs-dropdown {
        position: absolute;
        top: calc(100% + .7rem);
        inset-inline-start: 0;
        width: 285px;
        overflow: hidden;
        padding: .6rem;
        border: 1px solid var(--cfs-line);
        border-radius: 1.1rem;
        background: rgba(255, 255, 255, .97);
        box-shadow: 0 20px 55px rgba(15, 23, 42, .12);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        transform-origin: top center;
    }

    [dir="rtl"] .cfs-dropdown {
        transform-origin: top right;
    }


    /* =========================================================
       DROPDOWN HEADER
       ========================================================= */

    .cfs-dropdown-header {
        padding: .75rem .8rem .65rem;
        border-bottom: 1px solid var(--cfs-line);
        margin-bottom: .35rem;
    }

    .cfs-dropdown-kicker {
        display: block;
        color: var(--cfs-primary);
        font-size: .63rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .cfs-dropdown-title {
        display: block;
        margin-top: .15rem;
        color: var(--cfs-text);
        font-size: .8rem;
        font-weight: 700;
    }


    /* =========================================================
       DROPDOWN ITEMS
       ========================================================= */

    .cfs-dropdown-list {
        display: flex;
        flex-direction: column;
        gap: .15rem;
    }

    .cfs-dropdown-link {
        display: flex;
        align-items: center;
        gap: .65rem;
        padding: .62rem .6rem;
        border-radius: .75rem;
        color: var(--cfs-text-2);
        font-size: .78rem;
        text-decoration: none;
        transition: all .2s ease;
    }

    .cfs-dropdown-link:hover {
        background: var(--cfs-bg);
        color: var(--cfs-text);
        transform: translateX(2px);
    }

    [dir="rtl"] .cfs-dropdown-link:hover {
        transform: translateX(-2px);
    }

    .cfs-dropdown-link.active {
        color: var(--cfs-primary-dark);
        background: rgba(14, 165, 233, .08);
        font-weight: 700;
    }

    .cfs-dropdown-icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: .65rem;
        color: var(--cfs-primary);
        background: rgba(14, 165, 233, .08);
        transition: all .2s ease;
    }

    .cfs-dropdown-link:hover .cfs-dropdown-icon {
        background: rgba(14, 165, 233, .14);
        transform: scale(1.04);
    }

    .cfs-dropdown-icon.create-icon {
        color: #059669;
        background: rgba(16, 185, 129, .09);
    }

    .cfs-dropdown-create:hover .create-icon {
        background: rgba(16, 185, 129, .15);
    }

    .cfs-dropdown-content {
        min-width: 0;
        flex: 1;
    }

    .cfs-dropdown-content strong {
        display: block;
        font-size: .78rem;
        font-weight: 700;
        line-height: 1.35;
    }

    .cfs-dropdown-content small {
        display: block;
        margin-top: .15rem;
        color: var(--cfs-text-3);
        font-size: .63rem;
        font-weight: 500;
        line-height: 1.4;
    }

    .cfs-dropdown-check {
        margin-inline-start: auto;
        color: #059669;
        font-size: .8rem;
    }

    .cfs-dropdown-arrow {
        margin-inline-start: auto;
        color: var(--cfs-text-3);
        font-size: .62rem;
        transition: transform .2s ease;
    }

    .cfs-dropdown-link:hover .cfs-dropdown-arrow {
        color: var(--cfs-primary);
        transform: translateX(2px);
    }

    [dir="rtl"] .cfs-dropdown-link:hover .cfs-dropdown-arrow {
        transform: translateX(-2px);
    }


    /* =========================================================
       DROPDOWN FOOTER
       ========================================================= */

    .cfs-dropdown-footer {
        display: flex;
        align-items: center;
        gap: .45rem;
        margin: .5rem .25rem .1rem;
        padding: .6rem .65rem;
        border-top: 1px solid var(--cfs-line);
        color: var(--cfs-text-3);
        font-size: .6rem;
        line-height: 1.4;
    }

    .cfs-dropdown-footer i {
        color: var(--cfs-primary);
        font-size: .65rem;
    }


    /* =========================================================
       RIGHT SIDE
       ========================================================= */

    .cfs-nav-actions {
        display: flex;
        align-items: center;
        gap: .7rem;
        flex-shrink: 0;
    }


    /* =========================================================
       LANGUAGE
       ========================================================= */

    .cfs-language {
        display: flex;
        align-items: center;
        gap: .25rem;
        font-size: .8rem;
        font-weight: 700;
    }

    .cfs-language a {
        color: var(--cfs-text-3);
        text-decoration: none;
        transition: color .2s ease;
    }

    .cfs-language a:hover,
    .cfs-language a.active {
        color: var(--cfs-primary);
    }

    .cfs-language span {
        color: var(--cfs-line-strong);
    }


    /* =========================================================
       USER
       ========================================================= */

    .cfs-user-button {
        display: flex;
        align-items: center;
        gap: .5rem;
        padding: .3rem .65rem .3rem .3rem;
        border: 1px solid var(--cfs-line);
        border-radius: 999px;
        background: rgba(248, 250, 252, .85);
        color: var(--cfs-text-2);
        font-family: inherit;
        font-size: .76rem;
        font-weight: 700;
        cursor: pointer;
        transition: all .25s ease;
    }

    [dir="rtl"] .cfs-user-button {
        padding: .3rem .3rem .3rem .65rem;
    }

    .cfs-user-button:hover {
        color: var(--cfs-primary-dark);
        border-color: rgba(14, 165, 233, .25);
        background: rgba(14, 165, 233, .06);
    }

    .cfs-user-avatar {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 50%;
        color: white;
        background: linear-gradient(
            135deg,
            var(--cfs-primary),
            var(--cfs-primary-dark)
        );
        font-size: .72rem;
        font-weight: 800;
    }

    .cfs-user-name {
        max-width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .cfs-user-chevron {
        font-size: .62rem;
        color: var(--cfs-text-3);
    }


    /* =========================================================
       ACCOUNT DROPDOWN
       ========================================================= */

    .cfs-account-header {
        display: flex;
        align-items: center;
        gap: .7rem;
        padding: .8rem 1rem;
        border-bottom: 1px solid var(--cfs-line);
        margin-bottom: .35rem;
    }

    .cfs-account-avatar {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: white;
        background: linear-gradient(
            135deg,
            var(--cfs-primary),
            var(--cfs-primary-dark)
        );
        font-weight: 800;
    }

    .cfs-account-header strong,
    .cfs-account-header span {
        display: block;
    }

    .cfs-account-header strong {
        color: var(--cfs-text);
        font-size: .78rem;
    }

    .cfs-account-header span {
        margin-top: .12rem;
        color: var(--cfs-text-3);
        font-size: .65rem;
    }


    /* =========================================================
       MOBILE TOGGLE
       ========================================================= */

    .cfs-mobile-toggle {
        display: none;
        width: 38px;
        height: 38px;
        border: 1px solid var(--cfs-line);
        border-radius: 50%;
        background: white;
        color: var(--cfs-text-2);
        cursor: pointer;
    }


    /* =========================================================
       MOBILE
       ========================================================= */

    @media (max-width: 1100px) {

        .cfs-desktop-nav,
        .cfs-language:not(.cfs-mobile-settings .cfs-language),
        .cfs-user-wrapper,
        .cfs-theme-toggle-desktop {
            display: none !important;
        }

        .cfs-mobile-toggle {
            display: flex !important;
            align-items: center;
            justify-content: center;
        }

        .cfs-brand-tagline {
            display: none;
        }

        .cfs-mobile-menu {
            border-top: 1px solid var(--cfs-line);
            padding: .85rem;
            width: 100%;
            max-height: calc(85vh - 90px);
            overflow-y: auto;
            overscroll-behavior: contain;
            scrollbar-width: thin;
            scrollbar-color: rgba(14, 165, 233, .3) transparent;
        }

        .cfs-mobile-menu::-webkit-scrollbar {
            width: 5px;
        }

        .cfs-mobile-menu::-webkit-scrollbar-track {
            background: transparent;
        }

        .cfs-mobile-menu::-webkit-scrollbar-thumb {
            background-color: rgba(14, 165, 233, .3);
            border-radius: 999px;
        }

        .cfs-mobile-links {
            display: flex;
            flex-direction: column;
            gap: .3rem;
            width: 100%;
        }

        /* Mobile Main Links */
        .cfs-mobile-link {
            display: flex;
            align-items: center;
            gap: .7rem;
            padding: .7rem .75rem;
            border-radius: .75rem;
            color: var(--cfs-text-2);
            font-size: .82rem;
            font-weight: 600;
            text-decoration: none;
            width: 100%;
        }

        .cfs-mobile-link:hover,
        .cfs-mobile-link.active {
            color: var(--cfs-primary-dark);
            background: rgba(14, 165, 233, .08);
        }

        .cfs-mobile-link i {
            width: 20px;
            text-align: center;
            color: var(--cfs-primary);
        }

        /* Mobile Sections */
        .cfs-mobile-section {
            margin-top: .5rem;
            padding-top: .65rem;
            border-top: 1px solid var(--cfs-line);
            display: flex;
            flex-direction: column;
            gap: .3rem;
            width: 100%;
        }

        .cfs-mobile-section-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .5rem;
            padding: .45rem .75rem;
            color: var(--cfs-text-3);
            font-size: .67rem;
            font-weight: 800;
        }

        .cfs-mobile-section-title-main {
            display: flex;
            align-items: center;
            gap: .45rem;
        }

        .cfs-mobile-section-title-main i {
            color: var(--cfs-primary);
        }

        .cfs-mobile-section-badge {
            padding: .2rem .45rem;
            border-radius: 999px;
            background: rgba(14, 165, 233, .07);
            color: var(--cfs-primary-dark);
            font-size: .56rem;
            font-weight: 700;
        }

        /* Mobile Sub Items */
        .cfs-mobile-report {
            display: flex;
            align-items: center;
            gap: .65rem;
            padding: .62rem .75rem;
            border-radius: .75rem;
            color: var(--cfs-text-2);
            font-size: .77rem;
            text-decoration: none;
            transition: all .2s ease;
            width: 100%;
        }

        .cfs-mobile-report:hover,
        .cfs-mobile-report.active {
            color: var(--cfs-primary-dark);
            background: rgba(14, 165, 233, .07);
        }

        .cfs-mobile-report-icon {
            width: 31px;
            height: 31px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: .6rem;
            background: rgba(14, 165, 233, .08);
            color: var(--cfs-primary);
        }

        .cfs-mobile-report-icon.create-icon {
            background: rgba(16, 185, 129, .09);
            color: #059669;
        }

        .cfs-mobile-report-content {
            flex: 1;
            min-width: 0;
        }

        .cfs-mobile-report-content strong {
            display: block;
            font-size: .76rem;
        }

        .cfs-mobile-report-content small {
            display: block;
            margin-top: .12rem;
            color: var(--cfs-text-3);
            font-size: .61rem;
        }

        .cfs-mobile-active-check {
            margin-inline-start: auto;
            color: #059669;
            font-size: .68rem;
        }

        /* Mobile Account */
        .cfs-mobile-account {
            margin-top: .7rem;
            padding-top: .7rem;
            border-top: 1px solid var(--cfs-line);
            display: flex;
            flex-direction: column;
            gap: .3rem;
            width: 100%;
        }

        .cfs-mobile-account-user {
            display: flex;
            align-items: center;
            gap: .65rem;
            padding: .4rem .7rem .7rem;
        }

        .cfs-mobile-account-user strong,
        .cfs-mobile-account-user span:not(.cfs-user-avatar) {
            display: block;
        }

        .cfs-mobile-account-user strong {
            font-size: .78rem;
            color: var(--cfs-text);
        }

        .cfs-mobile-account-user span:not(.cfs-user-avatar) {
            color: var(--cfs-text-3);
            font-size: .65rem;
        }
    }


    /* Small Phone adjustments */
    @media (max-width: 640px) {
        .cfs-nav-wrap {
            padding: .7rem .7rem 0;
        }

        .cfs-nav-inner {
            min-height: 62px;
            padding: .55rem .7rem;
        }

        .cfs-user-name {
            display: none;
        }

        .cfs-brand-name {
            font-size: .88rem;
        }

        .cfs-brand-icon {
            width: 38px;
            height: 38px;
        }
    }

</style>
<?php /**PATH C:\xampp\htdocs\cfs-sms\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>