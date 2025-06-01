import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        if (typeof Livewire !== 'undefined') {
            console.log('Livewire detected, starting Alpine after Livewire init');
            
            document.addEventListener('livewire:init', () => {
                Alpine.start();
                console.log('Alpine started after Livewire init');
            });
            
        } else {
            console.log('No Livewire detected, starting Alpine normally');
            Alpine.start();
        }
    }, 100);
});