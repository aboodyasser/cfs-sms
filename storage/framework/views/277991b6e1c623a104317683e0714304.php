<?php if(session('success')): ?>
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         x-transition:enter="transform ease-out duration-300 transition"
         x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
         x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed bottom-4 right-4 rtl:left-4 rtl:right-auto z-[9999] flex max-w-sm w-full bg-white dark:bg-slate-800 shadow-xl rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden border-l-4 border-emerald-500">
        <div class="p-4 w-full">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-xl"></i>
                </div>
                <div class="ml-3 rtl:mr-3 rtl:ml-0 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">
                        <?php echo e(__('Success!')); ?>

                    </p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">
                        <?php echo e(__(session('success'))); ?>

                    </p>
                </div>
                <div class="ml-4 rtl:mr-4 rtl:ml-0 flex-shrink-0 flex">
                    <button @click="show = false" class="bg-transparent rounded-md inline-flex text-slate-400 hover:text-slate-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
         x-transition:enter="transform ease-out duration-300 transition"
         x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
         x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed bottom-4 right-4 rtl:left-4 rtl:right-auto z-[9999] flex max-w-sm w-full bg-white dark:bg-slate-800 shadow-xl rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden border-l-4 border-red-500">
        <div class="p-4 w-full">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fa-solid fa-circle-xmark text-red-500 text-xl"></i>
                </div>
                <div class="ml-3 rtl:mr-3 rtl:ml-0 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">
                        <?php echo e(__('Error!')); ?>

                    </p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">
                        <?php echo e(__(session('error'))); ?>

                    </p>
                </div>
                <div class="ml-4 rtl:mr-4 rtl:ml-0 flex-shrink-0 flex">
                    <button @click="show = false" class="bg-transparent rounded-md inline-flex text-slate-400 hover:text-slate-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\cfs-sms\resources\views/partials/toast.blade.php ENDPATH**/ ?>