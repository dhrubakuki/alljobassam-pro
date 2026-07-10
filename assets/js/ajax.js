/**
 * AJAX Functions
 * AllJobAssam Pro Theme
 */

(function() {
    'use strict';

    const AJAX = {
        // Search Jobs
        search(query) {
            if (query.length < 2) {
                console.warn('Minimum 2 characters required');
                return;
            }

            const data = {
                action: 'alljobassam_search',
                nonce: alljobassamAjax.nonce,
                search: query
            };

            this.request(data, (response) => {
                if (response.success) {
                    this.displaySearchResults(response.data);
                }
            });
        },

        // Display Search Results
        displaySearchResults(results) {
            const resultsContainer = document.getElementById('search-results');
            if (!resultsContainer) return;

            let html = '';
            if (results.length === 0) {
                html = '<p class="no-results">No results found</p>';
            } else {
                results.forEach(result => {
                    html += `
                        <div class="search-result-item">
                            <a href="${result.url}">
                                <strong>${result.title}</strong>
                                <span class="result-type">${result.type}</span>
                            </a>
                        </div>
                    `;
                });
            }

            resultsContainer.innerHTML = html;
            resultsContainer.classList.add('active');
        },

        // Load More Posts
        loadMore(postType, page) {
            const data = {
                action: 'alljobassam_load_more',
                nonce: alljobassamAjax.nonce,
                post_type: postType,
                paged: page
            };

            this.request(data, (response) => {
                if (response.success) {
                    this.appendPosts(response.data.html, postType);
                    
                    // Update load more button
                    const loadMoreBtn = document.getElementById('load-more');
                    if (loadMoreBtn) {
                        if (page >= response.data.max_pages) {
                            loadMoreBtn.style.display = 'none';
                        } else {
                            loadMoreBtn.setAttribute('data-page', page + 1);
                        }
                    }
                }
            });
        },

        // Append Posts to Container
        appendPosts(html, postType) {
            const container = document.querySelector('.posts-grid, .jobs-grid');
            if (container) {
                const temp = document.createElement('div');
                temp.innerHTML = html;
                
                const items = temp.querySelectorAll('[class*="item"], [class*="card"]');
                items.forEach(item => {
                    const clone = item.cloneNode(true);
                    clone.classList.add('animate-slide-in');
                    container.appendChild(clone);
                });
            }
        },

        // Subscribe to Newsletter
        subscribe(email) {
            const data = {
                action: 'alljobassam_subscribe',
                nonce: alljobassamAjax.nonce,
                email: email
            };

            this.request(data, (response) => {
                const form = document.querySelector('.newsletter-form');
                if (form) {
                    if (response.success) {
                        this.showNotification('Successfully subscribed!', 'success');
                        form.reset();
                    } else {
                        this.showNotification(response.data || 'Subscription failed', 'error');
                    }
                }
            });
        },

        // Submit Contact Form
        submitContactForm(formData) {
            const data = {
                action: 'alljobassam_contact',
                nonce: alljobassamAjax.nonce,
                ...formData
            };

            this.request(data, (response) => {
                if (response.success) {
                    this.showNotification('Message sent successfully!', 'success');
                    document.getElementById('contact-form')?.reset();
                } else {
                    this.showNotification(response.data || 'Failed to send message', 'error');
                }
            });
        },

        // Track View Count
        trackView(postId) {
            const data = {
                action: 'alljobassam_track_view',
                nonce: alljobassamAjax.nonce,
                post_id: postId
            };

            this.request(data, null, false); // Don't show response
        },

        // Apply for Job
        applyJob(jobId, email) {
            const data = {
                action: 'alljobassam_apply_job',
                nonce: alljobassamAjax.nonce,
                job_id: jobId,
                email: email
            };

            this.request(data, (response) => {
                if (response.success) {
                    this.showNotification('Application submitted successfully!', 'success');
                } else {
                    this.showNotification(response.data || 'Failed to submit application', 'error');
                }
            });
        },

        // Get Notifications
        getNotifications() {
            const data = {
                action: 'alljobassam_get_notifications',
                nonce: alljobassamAjax.nonce
            };

            this.request(data, (response) => {
                if (response.success && response.data.length > 0) {
                    this.displayNotifications(response.data);
                }
            });
        },

        // Display Notifications
        displayNotifications(notifications) {
            const container = document.getElementById('notifications-container');
            if (!container) return;

            notifications.forEach(notification => {
                const notifEl = document.createElement('div');
                notifEl.className = `notification notification-${notification.type}`;
                notifEl.innerHTML = `
                    <div class="notification-content">
                        <p>${notification.message}</p>
                        <button class="close-notification" onclick="this.parentElement.remove()">×</button>
                    </div>
                `;
                container.appendChild(notifEl);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    notifEl.remove();
                }, 5000);
            });
        },

        // Export to PDF
        exportPDF(postId, fileName) {
            const url = `${alljobassamAjax.ajaxurl}?action=alljobassam_export_pdf&post_id=${postId}&nonce=${alljobassamAjax.nonce}`;
            window.location.href = url;
        },

        // Share Post
        sharePost(postId, platform) {
            const data = {
                action: 'alljobassam_share_post',
                nonce: alljobassamAjax.nonce,
                post_id: postId,
                platform: platform
            };

            this.request(data, (response) => {
                if (response.success) {
                    const url = encodeURIComponent(window.location.href);
                    const title = encodeURIComponent(document.title);
                    
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
            });
        },

        // Filter Jobs
        filterJobs(filters) {
            const data = {
                action: 'alljobassam_filter_jobs',
                nonce: alljobassamAjax.nonce,
                filters: filters
            };

            this.request(data, (response) => {
                if (response.success) {
                    this.appendPosts(response.data.html, 'job');
                }
            });
        },

        // Get Job Details
        getJobDetails(jobId) {
            const data = {
                action: 'alljobassam_get_job_details',
                nonce: alljobassamAjax.nonce,
                job_id: jobId
            };

            return new Promise((resolve, reject) => {
                this.request(data, (response) => {
                    if (response.success) {
                        resolve(response.data);
                    } else {
                        reject(response.data);
                    }
                });
            });
        },

        // Core AJAX Request
        request(data, callback, showLoader = true) {
            if (showLoader) {
                this.showLoader();
            }

            fetch(alljobassamAjax.ajaxurl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(data)
            })
            .then(response => response.json())
            .then(response => {
                if (showLoader) {
                    this.hideLoader();
                }
                if (callback && typeof callback === 'function') {
                    callback(response);
                }
            })
            .catch(error => {
                if (showLoader) {
                    this.hideLoader();
                }
                console.error('AJAX Error:', error);
                this.showNotification('An error occurred. Please try again.', 'error');
            });
        },

        // Show/Hide Loader
        showLoader() {
            let loader = document.getElementById('ajax-loader');
            if (!loader) {
                loader = document.createElement('div');
                loader.id = 'ajax-loader';
                loader.className = 'ajax-loader';
                loader.innerHTML = '<div class="spinner"></div>';
                document.body.appendChild(loader);
            }
            loader.style.display = 'flex';
        },

        hideLoader() {
            const loader = document.getElementById('ajax-loader');
            if (loader) {
                loader.style.display = 'none';
            }
        },

        // Show Notification
        showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `notification notification-${type} animate-slide-in`;
            notification.innerHTML = `
                <div class="notification-content">
                    <p>${message}</p>
                    <button class="close-notification" onclick="this.parentElement.parentElement.remove()">×</button>
                </div>
            `;

            const container = document.getElementById('notifications-container') || document.body;
            container.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.remove();
            }, 5000);
        }
    };

    // Event Listeners Setup
    function setupEventListeners() {
        // Search
        const searchForms = document.querySelectorAll('form[data-search]');
        searchForms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const query = form.querySelector('input[type="search"]').value;
                AJAX.search(query);
            });

            // Live search on input
            const searchInput = form.querySelector('input[type="search"]');
            if (searchInput) {
                searchInput.addEventListener('input', debounce((e) => {
                    if (e.target.value.length >= 2) {
                        AJAX.search(e.target.value);
                    }
                }, 300));
            }
        });

        // Load More Button
        const loadMoreBtn = document.getElementById('load-more');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', () => {
                const page = parseInt(loadMoreBtn.getAttribute('data-page')) || 2;
                const postType = loadMoreBtn.getAttribute('data-post-type') || 'job';
                AJAX.loadMore(postType, page);
            });
        }

        // Newsletter Form
        const newsletterForm = document.querySelector('.newsletter-form');
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const email = newsletterForm.querySelector('input[type="email"]').value;
                AJAX.subscribe(email);
            });
        }

        // Contact Form
        const contactForm = document.getElementById('contact-form');
        if (contactForm) {
            contactForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const formData = new FormData(contactForm);
                const data = Object.fromEntries(formData);
                AJAX.submitContactForm(data);
            });
        }

        // Share Buttons
        const shareButtons = document.querySelectorAll('.btn-share');
        shareButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const platform = btn.getAttribute('data-platform');
                const postId = btn.getAttribute('data-post-id');
                AJAX.sharePost(postId, platform);
            });
        });

        // Filter Form
        const filterForm = document.querySelector('form[data-filter]');
        if (filterForm) {
            filterForm.addEventListener('change', () => {
                const formData = new FormData(filterForm);
                const filters = Object.fromEntries(formData);
                AJAX.filterJobs(filters);
            });
        }

        // Track Views
        const postId = document.querySelector('article').getAttribute('id')?.replace('post-', '');
        if (postId) {
            AJAX.trackView(postId);
        }

        // Get Notifications on Load
        AJAX.getNotifications();
    }

    // Debounce Helper
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Initialize on DOM Ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setupEventListeners);
    } else {
        setupEventListeners();
    }

    // Export for global use
    window.AJAX = AJAX;
})();
