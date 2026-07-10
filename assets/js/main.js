/**
 * Main JavaScript File
 * AllJobAssam Pro Theme
 */

(function() {
    'use strict';

    // Theme Initialization
    const App = {
        init() {
            this.setupEventListeners();
            this.setupMobileMenu();
            this.setupScrollBehavior();
            this.setupThemeToggle();
            this.setupScrollToTop();
            this.setupStickyHeader();
            this.setupMegaMenu();
        },

        // Event Listeners
        setupEventListeners() {
            document.addEventListener('DOMContentLoaded', () => {
                this.initializeComponents();
            });

            window.addEventListener('scroll', () => {
                this.handleScroll();
            });

            window.addEventListener('resize', () => {
                this.handleResize();
            });
        },

        // Mobile Menu Toggle
        setupMobileMenu() {
            const menuToggle = document.querySelector('.menu-toggle');
            const mainNav = document.querySelector('.main-navigation');

            if (menuToggle && mainNav) {
                menuToggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    mainNav.classList.toggle('active');
                    menuToggle.setAttribute('aria-expanded', 
                        menuToggle.getAttribute('aria-expanded') === 'false' ? 'true' : 'false'
                    );
                });

                // Close menu when clicking outside
                document.addEventListener('click', (e) => {
                    if (!e.target.closest('.site-header')) {
                        mainNav.classList.remove('active');
                        menuToggle.setAttribute('aria-expanded', 'false');
                    }
                });

                // Close menu on link click
                mainNav.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        mainNav.classList.remove('active');
                        menuToggle.setAttribute('aria-expanded', 'false');
                    });
                });
            }
        },

        // Scroll Behavior
        setupScrollBehavior() {
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        },

        // Scroll Progress Bar
        handleScroll() {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            
            const progressBar = document.querySelector('.scroll-progress-bar');
            if (progressBar) {
                progressBar.style.width = scrollPercent + '%';
            }

            // Show/Hide scroll to top button
            const scrollToTopBtn = document.getElementById('scroll-to-top');
            if (scrollToTopBtn) {
                scrollToTopBtn.classList.toggle('show', scrollTop > 300);
            }

            // Update sticky header shadow
            const stickyHeader = document.querySelector('.sticky-header');
            if (stickyHeader) {
                stickyHeader.classList.toggle('has-shadow', scrollTop > 0);
            }
        },

        // Handle Resize
        handleResize() {
            // Close mobile menu on resize to desktop
            if (window.innerWidth > 768) {
                const mainNav = document.querySelector('.main-navigation');
                const menuToggle = document.querySelector('.menu-toggle');
                if (mainNav && menuToggle) {
                    mainNav.classList.remove('active');
                    menuToggle.setAttribute('aria-expanded', 'false');
                }
            }
        },

        // Theme Toggle (Dark Mode)
        setupThemeToggle() {
            const themeToggle = document.getElementById('theme-toggle');
            if (!themeToggle) return;

            const currentTheme = localStorage.getItem('theme') || 'light';
            if (currentTheme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
            }

            themeToggle.addEventListener('click', () => {
                const theme = document.documentElement.getAttribute('data-theme');
                const newTheme = theme === 'dark' ? 'light' : 'dark';
                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
            });
        },

        // Scroll to Top
        setupScrollToTop() {
            const scrollToTopBtn = document.getElementById('scroll-to-top');
            if (scrollToTopBtn) {
                scrollToTopBtn.addEventListener('click', () => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        },

        // Sticky Header
        setupStickyHeader() {
            const stickyHeader = document.querySelector('.sticky-header');
            if (stickyHeader && window.innerWidth > 768) {
                // Header becomes sticky via CSS
            }
        },

        // Mega Menu
        setupMegaMenu() {
            const menuItems = document.querySelectorAll('.menu > li');
            menuItems.forEach(item => {
                const hasSubmenu = item.querySelector('.mega-menu');
                if (hasSubmenu) {
                    item.addEventListener('mouseenter', () => {
                        hasSubmenu.classList.add('active');
                    });
                    item.addEventListener('mouseleave', () => {
                        hasSubmenu.classList.remove('active');
                    });
                }
            });
        },

        // Initialize Components
        initializeComponents() {
            this.setupAccordion();
            this.setupTabs();
            this.setupModals();
            this.setupImageLazy();
            this.setupFormValidation();
        },

        // Accordion
        setupAccordion() {
            const accordions = document.querySelectorAll('.accordion-item');
            accordions.forEach(item => {
                const header = item.querySelector('.accordion-header');
                const content = item.querySelector('.accordion-content');
                
                if (header && content) {
                    header.addEventListener('click', () => {
                        const isActive = item.classList.contains('active');
                        
                        // Close all other accordions
                        document.querySelectorAll('.accordion-item.active').forEach(activeItem => {
                            activeItem.classList.remove('active');
                        });
                        
                        // Toggle current
                        if (!isActive) {
                            item.classList.add('active');
                        }
                    });
                }
            });
        },

        // Tabs
        setupTabs() {
            const tabButtons = document.querySelectorAll('[data-tab]');
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const tabName = button.getAttribute('data-tab');
                    const tabContainer = button.closest('.tabs-container');
                    
                    if (tabContainer) {
                        // Hide all tabs
                        tabContainer.querySelectorAll('.tab-content').forEach(tab => {
                            tab.classList.remove('active');
                        });
                        
                        // Remove active class from all buttons
                        tabContainer.querySelectorAll('[data-tab]').forEach(btn => {
                            btn.classList.remove('active');
                        });
                        
                        // Show selected tab
                        const selectedTab = tabContainer.querySelector(`[data-tab-content="${tabName}"]`);
                        if (selectedTab) {
                            selectedTab.classList.add('active');
                        }
                        
                        // Add active class to clicked button
                        button.classList.add('active');
                    }
                });
            });
        },

        // Modals
        setupModals() {
            const modalTriggers = document.querySelectorAll('[data-modal-trigger]');
            const modals = document.querySelectorAll('.modal');
            
            modalTriggers.forEach(trigger => {
                trigger.addEventListener('click', (e) => {
                    e.preventDefault();
                    const modalId = trigger.getAttribute('data-modal-trigger');
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.add('active');
                    }
                });
            });
            
            modals.forEach(modal => {
                const closeBtn = modal.querySelector('.modal-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        modal.classList.remove('active');
                    });
                }
                
                // Close on outside click
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.classList.remove('active');
                    }
                });
            });
        },

        // Lazy Loading Images
        setupImageLazy() {
            if ('IntersectionObserver' in window) {
                const images = document.querySelectorAll('img[data-src]');
                const imageObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.getAttribute('data-src');
                            img.removeAttribute('data-src');
                            imageObserver.unobserve(img);
                        }
                    });
                });
                
                images.forEach(img => imageObserver.observe(img));
            }
        },

        // Form Validation
        setupFormValidation() {
            const forms = document.querySelectorAll('form[data-validate]');
            forms.forEach(form => {
                form.addEventListener('submit', (e) => {
                    if (!this.validateForm(form)) {
                        e.preventDefault();
                    }
                });
            });
        },

        validateForm(form) {
            const inputs = form.querySelectorAll('[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('error');
                    isValid = false;
                } else {
                    input.classList.remove('error');
                }
            });
            
            return isValid;
        }
    };

    // Utility Functions
    const Utils = {
        // Format Date
        formatDate(date) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(date).toLocaleDateString('en-IN', options);
        },

        // Format Number
        formatNumber(num) {
            return new Intl.NumberFormat('en-IN').format(num);
        },

        // Get Query Parameter
        getQueryParam(param) {
            const params = new URLSearchParams(window.location.search);
            return params.get(param);
        },

        // Debounce Function
        debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        },

        // Throttle Function
        throttle(func, limit) {
            let inThrottle;
            return function(...args) {
                if (!inThrottle) {
                    func.apply(this, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            };
        }
    };

    // Copy to Clipboard
    function copyToClipboard(text) {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(() => {
                console.log('Copied to clipboard');
            });
        }
    }

    // Print Page
    function printPage() {
        window.print();
    }

    // Share Functionality
    function shareUrl(platform, url, title) {
        const shareUrls = {
            facebook: `https://www.facebook.com/sharer/sharer.php?u=${url}`,
            twitter: `https://twitter.com/intent/tweet?url=${url}&text=${title}`,
            linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${url}`,
            whatsapp: `https://wa.me/?text=${title}%20${url}`,
            telegram: `https://t.me/share/url?url=${url}&text=${title}`
        };

        if (shareUrls[platform]) {
            window.open(shareUrls[platform], '_blank', 'width=600,height=400');
        }
    }

    // Export for global use
    window.App = App;
    window.Utils = Utils;
    window.copyToClipboard = copyToClipboard;
    window.printPage = printPage;
    window.shareUrl = shareUrl;

    // Initialize App when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => App.init());
    } else {
        App.init();
    }
})();
