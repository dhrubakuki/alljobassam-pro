<?php
/**
 * 404 Not Found template
 * 
 * @package AllJobAssam_Pro
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="error-404">
            <div class="error-illustration">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="100" cy="100" r="95" fill="none" stroke="#0066cc" stroke-width="2"/>
                    <text x="50%" y="50%" font-size="80" font-weight="bold" text-anchor="middle" dominant-baseline="middle" fill="#0066cc">404</text>
                </svg>
            </div>

            <h1><?php echo esc_html__( 'Page Not Found', 'alljobassam-pro' ); ?></h1>
            <p><?php echo esc_html__( 'The page you are looking for does not exist or has been removed.', 'alljobassam-pro' ); ?></p>

            <!-- Search Form -->
            <form class="error-search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="search" name="s" placeholder="<?php echo esc_attr__( 'Search for something...', 'alljobassam-pro' ); ?>">
                <button type="submit" class="btn btn-primary"><?php echo esc_html__( 'Search', 'alljobassam-pro' ); ?></button>
            </form>

            <!-- Suggestions -->
            <div class="error-suggestions">
                <h3><?php echo esc_html__( 'Go to:', 'alljobassam-pro' ); ?></h3>
                <div class="suggestion-links">
                    <a href="<?php echo esc_url( home_url() ); ?>" class="btn btn-secondary"><?php echo esc_html__( 'Home', 'alljobassam-pro' ); ?></a>
                    <a href="<?php echo esc_url( home_url( '/jobs' ) ); ?>" class="btn btn-secondary"><?php echo esc_html__( 'Jobs', 'alljobassam-pro' ); ?></a>
                    <a href="<?php echo esc_url( home_url( '/results' ) ); ?>" class="btn btn-secondary"><?php echo esc_html__( 'Results', 'alljobassam-pro' ); ?></a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
