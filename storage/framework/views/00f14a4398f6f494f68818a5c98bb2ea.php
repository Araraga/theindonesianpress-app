<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

?>

<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Pengaturan Profil']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pengaturan Profil']); ?>
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
                <h1 class="font-extrabold text-2xl mb-2" style="color:#FFF6BE !important;">Settings</h1>
                <div class="text-base mb-6" style="color:#fefefe !important;">Manage your profile and account settings</div>
                <div data-orientation="horizontal" role="none" class="h-px w-full" style="background:#1e40af !important; opacity:0.2 !important;"></div>
            </div>
            <div class="flex items-start max-md:flex-col">
                <div class="me-10 w-full pb-4 md:w-[220px]">
                    <nav class="flex flex-col overflow-visible min-h-auto">
                        <a href="/settings/profile" class="h-10 lg:h-8 flex items-center gap-3 rounded-lg px-3 my-px font-bold bg-blue-50 hover:bg-blue-100 transition" style="color:#fefefe !important; background:transparent !important;">Profile</a>
                        <a href="/settings/password" class="h-10 lg:h-8 flex items-center gap-3 rounded-lg px-3 my-px font-bold bg-blue-50 hover:bg-blue-100 transition" style="color:#fefefe !important; background:transparent !important;">Password</a>
                    </nav>
                </div>
                <div class="flex-1 self-stretch max-md:pt-6">
                    <div class="font-extrabold text-xl mb-2" style="color:#fefefe !important;">Profil Pengguna</div>
                    <div class="text-base mb-6" style="color:#fefefe !important;">Perbarui nama dan email akun Anda di sini.</div>
                    <div class="mt-5 w-full max-w-lg">
                        <form class="my-6 w-full space-y-8">
                            <div class="flex flex-col gap-6">
                                <div>
                                    <label class="block text-lg font-bold mb-2" for="name" style="color:#fefefe !important;">Nama</label>
                                    <input wire:model="name" id="name" name="name" type="text" required autofocus autocomplete="name" class="w-full px-5 py-3 rounded-lg border-2 font-semibold focus:ring-2 outline-none text-lg placeholder:text-gray-400 transition" style="color:#fefefe !important; background-color:transparent !important; border-color:#fefefe !important; outline:2px solid #fefefe !important;">
                                </div>
                                <div>
                                    <label class="block text-lg font-bold mb-2" for="email" style="color:#fefefe !important;">Email</label>
                                    <input wire:model="email" id="email" name="email" type="email" required autocomplete="email" class="w-full px-5 py-3 rounded-lg border-2 font-semibold focus:ring-2 outline-none text-lg placeholder:text-gray-400 transition" style="color:#fefefe !important; background-color:transparent !important; border-color:#fefefe !important; outline:2px solid #fefefe !important;">
                                </div>
                            </div>
                            <div class="flex justify-between mt-8">
                                <a href="#" onclick="window.history.length > 1 ? window.history.back() : window.location='<?php echo e(route('dashboard')); ?>'; return false;" class="px-8 py-3 rounded-lg font-bold text-lg shadow transition" style="background:transparent !important; color:#fefefe !important; border:2px solid #444 !important;">Kembali</a>
                                <button type="submit" class="px-8 py-3 rounded-lg font-bold text-lg shadow transition" style="background:#7E2320 !important; color:#FFF6BE !important;">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
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
<?php endif; ?><?php /**PATH C:\laragon\www\theindonesianpress-app\resources\views\livewire/settings/profile.blade.php ENDPATH**/ ?>