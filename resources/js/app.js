import './bootstrap';

window.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('a[href^="#"]').forEach((link) => {
        link.addEventListener('click', () => {
            document.querySelectorAll('a[href^="#"]').forEach((item) => item.classList.remove('text-[#3B0066]'));
        });
    });
});
