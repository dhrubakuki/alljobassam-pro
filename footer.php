<?php
/**
 * Footer template
 * 
 * @package AllJobAssam_Pro
 */

?>

    <!-- Floating WhatsApp Button -->
    <div class="floating-whatsapp">
        <a href="https://wa.me/919999999999" target="_blank" title="<?php echo esc_attr__( 'Chat on WhatsApp', 'alljobassam-pro' ); ?>">
            <i class="icon-whatsapp"></i>
        </a>
    </div>

    <!-- Scroll to Top Button -->
    <button class="scroll-to-top" id="scroll-to-top" aria-label="<?php echo esc_attr__( 'Scroll to top', 'alljobassam-pro' ); ?>">
        <i class="icon-arrow-up"></i>
    </button>

    <!-- Footer -->
    <footer id="colophon" class="site-footer">
        <!-- Newsletter Section -->
        <div class="footer-newsletter">
            <div class="container">
                <div class="newsletter-content">
                    <h3><?php echo esc_html__( 'Subscribe to Newsletter', 'alljobassam-pro' ); ?></h3>
                    <p><?php echo esc_html__( 'Get latest job updates directly to your inbox', 'alljobassam-pro' ); ?></p>
                    <form class="newsletter-form" method="post">
                        <input type="email" name="email" placeholder="<?php echo esc_attr__( 'Enter your email', 'alljobassam-pro' ); ?>" required>
                        <button type="submit" class="btn btn-primary"><?php echo esc_html__( 'Subscribe', 'alljobassam-pro' ); ?></button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Footer Content -->
        <div class="footer-main">
            <div class="container">
                <div class="footer-columns grid-4">
                    <!-- Column 1: About -->
                    <div class="footer-column">
                        <h4><?php echo esc_html__( 'About AllJobAssam', 'alljobassam-pro' ); ?></h4>
                        <p><?php echo esc_html__( 'AllJobAssam is your trusted platform for latest job notifications, results, admit cards and educational opportunities in Assam and across India.', 'alljobassam-pro' ); ?></p>
                        <div class="social-links">
                            <a href="https://facebook.com" target="_blank" title="Facebook"><i class="icon-facebook"></i></a>
                            <a href="https://twitter.com" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                            <a href="https://youtube.com" target="_blank" title="YouTube"><i class="icon-youtube"></i></a>
                            <a href="https://telegram.com" target="_blank" title="Telegram"><i class="icon-telegram"></i></a>
                        </div>
                    </div>

                    <!-- Column 2: Quick Links -->
                    <div class="footer-column">
                        <h4><?php echo esc_html__( 'Quick Links', 'alljobassam-pro' ); ?></h4>
                        <ul>
                            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__( 'Home', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/jobs' ) ); ?>"><?php echo esc_html__( 'All Jobs', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/result' ) ); ?>"><?php echo esc_html__( 'Results', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/admit-card' ) ); ?>"><?php echo esc_html__( 'Admit Cards', 'alljobassam-pro' ); ?></a></li>
                        </ul>
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>

                    <!-- Column 3: Categories -->
                    <div class="footer-column">
                        <h4><?php echo esc_html__( 'Categories', 'alljobassam-pro' ); ?></h4>
                        <ul>
                            <li><a href="<?php echo esc_url( home_url( '/job-category/government' ) ); ?>"><?php echo esc_html__( 'Government Jobs', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/job-category/private' ) ); ?>"><?php echo esc_html__( 'Private Jobs', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/admission' ) ); ?>"><?php echo esc_html__( 'Admissions', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/scholarship' ) ); ?>"><?php echo esc_html__( 'Scholarships', 'alljobassam-pro' ); ?></a></li>
                        </ul>
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    </div>

                    <!-- Column 4: Contact -->
                    <div class="footer-column">
                        <h4><?php echo esc_html__( 'Follow Us', 'alljobassam-pro' ); ?></h4>
                        <p><?php echo esc_html__( 'Join our communities for instant updates', 'alljobassam-pro' ); ?></p>
                        <div class="footer-buttons">
                            <a href="https://t.me/alljobassam" target="_blank" class="btn btn-sm">
                                <i class="icon-telegram"></i> Telegram
                            </a>
                            <a href="https://wa.me/919999999999" target="_blank" class="btn btn-sm">
                                <i class="icon-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content flex-between">
                    <div class="copyright">
                        <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <strong><?php bloginfo( 'name' ); ?></strong>. <?php echo esc_html__( 'All Rights Reserved.', 'alljobassam-pro' ); ?></p>
                    </div>
                    <nav class="footer-menu">
                        <ul>
                            <li><a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>"><?php echo esc_html__( 'Privacy Policy', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/terms' ) ); ?>"><?php echo esc_html__( 'Terms & Conditions', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/disclaimer' ) ); ?>"><?php echo esc_html__( 'Disclaimer', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php echo esc_html__( 'Contact Us', 'alljobassam-pro' ); ?></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
