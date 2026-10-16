//
document.addEventListener('DOMContentLoaded', () => {
    // Hanya untuk halaman publik, bukan dashboard admin
    if (!document.body.hasAttribute('data-public')) return;

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Kartu putih: efek angkat dan tekan
    document
        .querySelectorAll('main .rounded-2xl.bg-white:not(.grid):not(:has(.content-body))')
        .forEach((el) => el.classList.add('tap-card'));

    if (reduceMotion || !('IntersectionObserver' in window)) return;

    // Lingkaran dekorasi di banner melayang pelan
    document
        .querySelectorAll('main section.relative.overflow-hidden > div.absolute')
        .forEach((el) => el.classList.add('float-slow'));

    // Elemen yang muncul bertahap saat digulir
    const targets = document.querySelectorAll(
        'main section.relative.overflow-hidden > div.relative > *, ' +
        'main section h2, main .rounded-2xl.bg-white, main article'
    );

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;

                const el = entry.target;
                const index = Array.from(el.parentElement.children).indexOf(el);
                el.style.animationDelay = (index % 4) * 90 + 'ms';
                el.classList.add('is-visible');
                observer.unobserve(el);
            });
        },
        { threshold: 0, rootMargin: '0px 0px -8% 0px' }
    );

    targets.forEach((el) => {
        el.classList.add('reveal');
        observer.observe(el);
    });

    // Angka statistik menghitung naik dari nol
    document.querySelectorAll('main section.z-10 p.text-3xl').forEach((el) => {
        const target = parseInt(el.textContent.trim(), 10);
        if (Number.isNaN(target)) return;

        const counter = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                counter.unobserve(el);

                const start = performance.now();
                const duration = 900;

                const tick = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    el.textContent = Math.round(target * (1 - Math.pow(1 - progress, 3)));
                    if (progress < 1) requestAnimationFrame(tick);
                };

                requestAnimationFrame(tick);
            });
        });

        counter.observe(el);
    });
});