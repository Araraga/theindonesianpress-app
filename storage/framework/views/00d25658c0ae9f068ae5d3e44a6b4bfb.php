<?php

use Livewire\Volt\Component;

?>

<section class="w-full min-h-screen flex flex-col items-center justify-center" style="background:linear-gradient(135deg,#e0e7ff 0%,#f0f6ff 100%) !important;">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-2xl border-4 border-blue-200 p-8 md:p-12" style="background:#fff !important; border-color:#1e40af !important;">
        <div class="relative mb-6 w-full">
            <h1 class="font-extrabold text-2xl mb-2" style="color:#1e40af !important;">Appearance</h1>
            <div class="text-base mb-6" style="color:#2563eb !important;">Update the appearance settings for your account</div>
            <div data-orientation="horizontal" role="none" class="h-px w-full" style="background:#1e40af !important; opacity:0.2 !important;"></div>
        </div>
        <div class="flex-1 self-stretch max-md:pt-6">
            <div class="mt-5 w-full max-w-lg mx-auto">
                <form class="my-6 w-full space-y-8">
                    <div class="flex flex-col gap-6">
                        <label class="block text-lg font-bold mb-4" style="color:#1e40af !important;">Tema Tampilan</label>
                        <div class="flex gap-6 justify-between">
                            <label class="flex items-center gap-3 cursor-pointer px-5 py-4 rounded-lg border-2 font-semibold transition" style="color:#1e40af !important; background-color:#f0f6ff !important; border-color:#1e40af !important;">
                                <input type="radio" name="appearance" value="light" class="accent-blue-700" checked />
                                <span>Light</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer px-5 py-4 rounded-lg border-2 font-semibold transition" style="color:#1e40af !important; background-color:#f0f6ff !important; border-color:#1e40af !important;">
                                <input type="radio" name="appearance" value="dark" class="accent-blue-700" />
                                <span>Dark</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer px-5 py-4 rounded-lg border-2 font-semibold transition" style="color:#1e40af !important; background-color:#f0f6ff !important; border-color:#1e40af !important;">
                                <input type="radio" name="appearance" value="system" class="accent-blue-700" />
                                <span>System</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section><?php /**PATH C:\laragon\www\theindonesianpress-app\resources\views\livewire/settings/appearance.blade.php ENDPATH**/ ?>