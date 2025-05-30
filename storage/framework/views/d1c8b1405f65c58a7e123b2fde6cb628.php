<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

?>

<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Pengaturan Password']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pengaturan Password']); ?>
<div class="min-h-screen flex flex-col">
    <?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
    
    <main class="flex-1 container mx-auto mx-4 md:mx-16 py-10 px-8 md:px-16 min-h-[60vh] flex flex-col justify-between" style="background: linear-gradient(180deg, #EDEDED 100%, #F5F5F5 60%, #EDEDED 100%);">
        <div class="w-full max-w-3xl mx-auto rounded-2xl shadow-2xl border-4 border-blue-200 p-8 md:p-12" style="background:#171717f7 !important; border-color:#1e40af !important;">
            <div class="relative mb-6 w-full">
                <h1 class="font-extrabold text-2xl mb-2" style="color:#FFF6BE !important;">Update Password</h1>
                <div class="text-base mb-6" style="color:#fefefe !important;">Ensure your account is using a long, random password to stay secure</div>
                <div data-orientation="horizontal" role="none" class="h-px w-full" style="background:#1e40af !important; opacity:0.2 !important;"></div>
            </div>
            <div class="flex-1 self-stretch max-md:pt-6">
                <div class="mt-5 w-full max-w-lg mx-auto">
                    <!--[if BLOCK]><![endif]--><?php if(session()->has('password_success')): ?>
                        <div class="mb-6 px-4 py-3 rounded-lg bg-green-100 border border-green-400 text-green-800 font-semibold text-center" style="color:#166534 !important; background:#bbf7d0 !important; border-color:#22c55e !important;">
                            <?php echo e(session('password_success')); ?>

                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <?php if(session()->has('password_error')): ?>
                        <div class="mb-6 px-4 py-3 rounded-lg bg-red-100 border border-red-400 text-red-800 font-semibold text-center" style="color:#b91c1c !important; background:#fee2e2 !important; border-color:#ef4444 !important;">
                            <?php echo e(session('password_error')); ?>

                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <form wire:submit="updatePassword" class="my-6 w-full space-y-8">
                        <div class="flex flex-col gap-6">
                            <div>
                                <label class="block text-lg font-bold mb-2" for="current_password" style="color:#fefefe !important;">Current Password</label>
                                <input wire:model="current_password" id="current_password" name="current_password" type="password" required autocomplete="current-password" class="w-full px-5 py-3 rounded-lg border-2 font-semibold focus:ring-2 outline-none text-lg placeholder:text-gray-400 transition" style="color:#fefefe !important; background-color:transparent !important; border-color:#fefefe !important; outline:2px solid #fefefe !important;" placeholder="Current Password" />
                            </div>
                            <div>
                                <label class="block text-lg font-bold mb-2" for="password" style="color:#fefefe !important;">New Password</label>
                                <input wire:model="password" id="password" name="password" type="password" required autocomplete="new-password" class="w-full px-5 py-3 rounded-lg border-2 font-semibold focus:ring-2 outline-none text-lg placeholder:text-gray-400 transition" style="color:#fefefe !important; background-color:transparent !important; border-color:#fefefe !important; outline:2px solid #fefefe !important;" placeholder="New Password" />
                            </div>
                            <div>
                                <label class="block text-lg font-bold mb-2" for="password_confirmation" style="color:#fefefe !important;">Confirm Password</label>
                                <input wire:model="password_confirmation" id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="w-full px-5 py-3 rounded-lg border-2 font-semibold focus:ring-2 outline-none text-lg placeholder:text-gray-400 transition" style="color:#fefefe !important; background-color:transparent !important; border-color:#fefefe !important; outline:2px solid #fefefe !important;" placeholder="Confirm Password" />
                            </div>
                        </div>
                        <div class="flex justify-between mt-8">
                            <a href="<?php echo e(route('settings.profile')); ?>" class="px-8 py-3 rounded-lg font-bold text-lg shadow transition" style="background:transparent !important; color:#fefefe !important; border:2px solid #fefefe !important;">Kembali</a>
                            <button type="submit" class="px-8 py-3 rounded-lg font-bold text-lg shadow transition" style="background:#7E2320 !important; color:#FFF6BE !important;">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\theindonesianpress-app\resources\views\livewire/settings/password.blade.php ENDPATH**/ ?>