document.addEventListener('DOMContentLoaded', () => {

    // --- Dark Mode Logic ---
    const themeToggleBtn = document.getElementById('theme-toggle');
    const htmlElement = document.documentElement;
    const bodyElement = document.body;

    // Check local storage or system preference
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        htmlElement.classList.add('dark');
        bodyElement.classList.add('dark');
    } else {
        htmlElement.classList.remove('dark');
        bodyElement.classList.remove('dark');
    }

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            htmlElement.classList.toggle('dark');
            bodyElement.classList.toggle('dark');

            if (htmlElement.classList.contains('dark')) {
                localStorage.theme = 'dark';
            } else {
                localStorage.theme = 'light';
            }
        });
    }

    // --- Search Modal Logic ---
    const searchBtn = document.querySelector('.fa-search')?.closest('button');
    const searchModal = document.getElementById('search-modal');
    const closeSearchBtn = document.getElementById('close-search');
    const searchBackdrop = document.getElementById('search-backdrop');
    const searchContent = document.getElementById('search-content');
    const searchInput = searchModal ? searchModal.querySelector('input[type="search"]') : null;

    function openSearch() {
        if (!searchModal) return;
        searchModal.classList.remove('opacity-0', 'pointer-events-none');
        searchContent.classList.remove('scale-95');
        searchContent.classList.add('scale-100');
        setTimeout(() => searchInput?.focus(), 100);
    }

    function closeSearch() {
        if (!searchModal) return;
        searchModal.classList.add('opacity-0', 'pointer-events-none');
        searchContent.classList.remove('scale-100');
        searchContent.classList.add('scale-95');
    }

    if (searchBtn) {
        searchBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openSearch();
        });
    }

    if (closeSearchBtn) closeSearchBtn.addEventListener('click', closeSearch);
    if (searchBackdrop) searchBackdrop.addEventListener('click', closeSearch);

    // Close on Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && searchModal && !searchModal.classList.contains('opacity-0')) {
            closeSearch();
        }
    });

    // --- Barba.js Logic ---
    if (typeof barba !== 'undefined' && typeof gsap !== 'undefined') {

        barba.init({
            debug: true, // Keep debug on to see errors
            timeout: 5000, // Increase timeout to 5s
            transitions: [{
                name: 'fade',
                sync: true, // Allow overlapping transitions
                leave(data) {
                    return new Promise(resolve => {
                        if (!data.current.container) {
                            resolve();
                            return;
                        }
                        gsap.to(data.current.container, {
                            opacity: 0,
                            duration: 0.3,
                            onComplete: resolve
                        });
                    });
                },
                enter(data) {
                    return new Promise(resolve => {
                        if (!data.next.container) {
                            resolve();
                            return;
                        }
                        // Ensure the next container is visible but transparent first
                        gsap.set(data.next.container, { opacity: 0 });
                        gsap.to(data.next.container, {
                            opacity: 1,
                            duration: 0.3,
                            onComplete: resolve
                        });
                    });
                }
            }]
        });

        // PJAX Loader Hooks
        const loader = document.getElementById('pjax-loader');

        barba.hooks.before(() => {
            document.body.classList.add('is-loading');
            if (loader) loader.classList.remove('opacity-0');
        });

        barba.hooks.after(() => {
            // Small delay to let the new content settle and show animation
            setTimeout(() => {
                document.body.classList.remove('is-loading');
                if (loader) loader.classList.add('opacity-0');
                window.scrollTo(0, 0);
            }, 600); // Increased delay for visibility

            // Re-bind Dark Mode toggle if it was replaced (because it's outside container but good practice)
            const newToggleBtn = document.getElementById('theme-toggle');
            if (newToggleBtn) {
                // Clone to remove old listeners to prevent duplicates if re-binding
                const freshBtn = newToggleBtn.cloneNode(true);
                newToggleBtn.parentNode.replaceChild(freshBtn, newToggleBtn);

                freshBtn.addEventListener('click', () => {
                    const html = document.documentElement;
                    const body = document.body;
                    html.classList.toggle('dark');
                    body.classList.toggle('dark');
                    localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
                });
            }

            // Re-bind Search Button if needed (it's in header so it persists, but just in case)
            const newSearchBtn = document.querySelector('.fa-search')?.closest('button');
            if (newSearchBtn) {
                // Remove old listeners not easily possible without named functions, 
                // but since header persists, we don't strictly need to re-bind unless header is reloaded.
                // For now, assuming header is static.
            }
        });
    } else {
        console.error('Barba or GSAP not found');
    }
});
