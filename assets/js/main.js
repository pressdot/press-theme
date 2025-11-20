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
        barba.hooks.before(() => {
            document.body.classList.add('is-loading');
        });

        barba.hooks.after(() => {
            // Small delay to let the new content settle and show animation
            setTimeout(() => {
                document.body.classList.remove('is-loading');
                window.scrollTo(0, 0);
            }, 600); // Increased delay for visibility

            // Re-bind Dark Mode toggle if it was replaced
            const newToggleBtn = document.getElementById('theme-toggle');
            if (newToggleBtn) {
                // Clone to remove old listeners
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
        });
    } else {
        console.error('Barba or GSAP not found');
    }
});
