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
    if (typeof barba !== 'undefined') {
        barba.init({
            transitions: [{
                name: 'opacity-transition',
                leave(data) {
                    return gsap.to(data.current.container, {
                        opacity: 0,
                        duration: 0.3
                    });
                },
                enter(data) {
                    return gsap.from(data.next.container, {
                        opacity: 0,
                        duration: 0.3
                    });
                }
            }],
            views: [{
                namespace: 'home',
                beforeEnter() {
                    // Re-init scripts if needed for Home
                }
            }, {
                namespace: 'single',
                beforeEnter() {
                    // Re-init scripts if needed for Single
                }
            }]
        });

        // Re-run inline scripts after transition (if any)
        barba.hooks.after(() => {
            // Re-bind Dark Mode toggle if it was replaced
             const newToggleBtn = document.getElementById('theme-toggle');
             if(newToggleBtn) {
                 // Remove old listeners to be safe (though DOM is replaced)
                 newToggleBtn.replaceWith(newToggleBtn.cloneNode(true));
                 const freshBtn = document.getElementById('theme-toggle');
                 
                 freshBtn.addEventListener('click', () => {
                    htmlElement.classList.toggle('dark');
                    bodyElement.classList.toggle('dark');
                    if (htmlElement.classList.contains('dark')) {
                        localStorage.theme = 'dark';
                    } else {
                        localStorage.theme = 'light';
                    }
                });
             }
             
             // Scroll to top
             window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});
