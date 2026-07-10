<?php
/**
 * Front page template
 * 
 * @package AllJobAssam_Pro
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <!-- SECTION 1: HERO BANNER -->
    <section class="hero-section">
        <div class="hero-background"></div>
        <div class="container">
            <div class="hero-content">
                <h1><?php echo esc_html__( 'Find Your Dream Job', 'alljobassam-pro' ); ?></h1>
                <p><?php echo esc_html__( 'Search from thousands of jobs and apply instantly', 'alljobassam-pro' ); ?></p>
                
                <!-- Search Form -->
                <form class="hero-search" method="get" action="<?php echo esc_url( home_url( '/jobs' ) ); ?>">
                    <input type="text" name="s" placeholder="<?php echo esc_attr__( 'Job Title, Keyword...', 'alljobassam-pro' ); ?>" class="search-input">
                    <button type="submit" class="btn btn-primary"><?php echo esc_html__( 'Search Jobs', 'alljobassam-pro' ); ?></button>
                </form>

                <!-- Trending Searches -->
                <div class="trending-searches">
                    <span><?php echo esc_html__( 'Trending:', 'alljobassam-pro' ); ?></span>
                    <a href="<?php echo esc_url( home_url( '/?s=ASSAM' ) ); ?>">ASSAM Jobs</a>
                    <a href="<?php echo esc_url( home_url( '/?s=Railway' ) ); ?>">Railway Jobs</a>
                    <a href="<?php echo esc_url( home_url( '/?s=Bank' ) ); ?>">Bank Jobs</a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: TODAY'S IMPORTANT JOBS -->
    <section class="section-important-jobs">
        <div class="container">
            <div class="section-header">
                <h2><?php echo esc_html__( "Today's Important Jobs", 'alljobassam-pro' ); ?></h2>
                <a href="<?php echo esc_url( home_url( '/jobs' ) ); ?>" class="btn btn-secondary"><?php echo esc_html__( 'View All', 'alljobassam-pro' ); ?></a>
            </div>

            <div class="jobs-grid grid-4">
                <?php
                $featured_jobs = new WP_Query( array(
                    'post_type' => 'job',
                    'posts_per_page' => 4,
                    'meta_key' => 'featured',
                    'meta_value' => 1,
                ) );

                if ( $featured_jobs->have_posts() ) {
                    while ( $featured_jobs->have_posts() ) {
                        $featured_jobs->the_post();
                        get_template_part( 'template-parts/job-card-premium' );
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- SECTION 3: CLOSING TODAY -->
    <section class="section-closing-today">
        <div class="container">
            <h2><?php echo esc_html__( 'Closing Today', 'alljobassam-pro' ); ?></h2>
            <div class="jobs-grid grid-3">
                <?php
                $closing_today = alljobassam_get_closing_jobs( 0 );

                if ( $closing_today->have_posts() ) {
                    while ( $closing_today->have_posts() ) {
                        $closing_today->the_post();
                        get_template_part( 'template-parts/job-card-closing' );
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- SECTION 4: CLOSING TOMORROW -->
    <section class="section-closing-tomorrow">
        <div class="container">
            <h2><?php echo esc_html__( 'Closing Tomorrow', 'alljobassam-pro' ); ?></h2>
            <div class="jobs-grid grid-3">
                <?php
                $closing_tomorrow = alljobassam_get_closing_jobs( 1 );

                if ( $closing_tomorrow->have_posts() ) {
                    while ( $closing_tomorrow->have_posts() ) {
                        $closing_tomorrow->the_post();
                        get_template_part( 'template-parts/job-card-warning' );
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- SECTION 5: LATEST GOVERNMENT JOBS -->
    <section class="section-government-jobs">
        <div class="container">
            <div class="section-header">
                <h2><?php echo esc_html__( 'Latest Government Jobs', 'alljobassam-pro' ); ?></h2>
                <a href="<?php echo esc_url( home_url( '/job-type/government' ) ); ?>" class="btn btn-secondary"><?php echo esc_html__( 'View All', 'alljobassam-pro' ); ?></a>
            </div>

            <div class="jobs-grid grid-3">
                <?php
                $govt_jobs = new WP_Query( array(
                    'post_type' => 'job',
                    'posts_per_page' => 9,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'job_type',
                            'field' => 'slug',
                            'terms' => 'government',
                        ),
                    ),
                ) );

                if ( $govt_jobs->have_posts() ) {
                    while ( $govt_jobs->have_posts() ) {
                        $govt_jobs->the_post();
                        get_template_part( 'template-parts/job-card' );
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- SECTION 6: LATEST PRIVATE JOBS -->
    <section class="section-private-jobs">
        <div class="container">
            <div class="section-header">
                <h2><?php echo esc_html__( 'Latest Private Jobs', 'alljobassam-pro' ); ?></h2>
                <a href="<?php echo esc_url( home_url( '/job-type/private' ) ); ?>" class="btn btn-secondary"><?php echo esc_html__( 'View All', 'alljobassam-pro' ); ?></a>
            </div>

            <div class="jobs-grid grid-3">
                <?php
                $private_jobs = new WP_Query( array(
                    'post_type' => 'job',
                    'posts_per_page' => 9,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'job_type',
                            'field' => 'slug',
                            'terms' => 'private',
                        ),
                    ),
                ) );

                if ( $private_jobs->have_posts() ) {
                    while ( $private_jobs->have_posts() ) {
                        $private_jobs->the_post();
                        get_template_part( 'template-parts/job-card' );
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- SECTION 7: ADMIT CARDS -->
    <section class="section-admit-cards">
        <div class="container">
            <h2><?php echo esc_html__( 'Latest Admit Cards', 'alljobassam-pro' ); ?></h2>
            <div class="jobs-grid grid-3">
                <?php
                $admit_cards = new WP_Query( array(
                    'post_type' => 'admit_card',
                    'posts_per_page' => 9,
                ) );

                if ( $admit_cards->have_posts() ) {
                    while ( $admit_cards->have_posts() ) {
                        $admit_cards->the_post();
                        get_template_part( 'template-parts/card-item' );
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- SECTION 8: RESULTS -->
    <section class="section-results">
        <div class="container">
            <h2><?php echo esc_html__( 'Latest Results', 'alljobassam-pro' ); ?></h2>
            <div class="jobs-grid grid-3">
                <?php
                $results = new WP_Query( array(
                    'post_type' => 'result',
                    'posts_per_page' => 9,
                ) );

                if ( $results->have_posts() ) {
                    while ( $results->have_posts() ) {
                        $results->the_post();
                        get_template_part( 'template-parts/card-item' );
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- SECTION 9: ADMISSIONS -->
    <section class="section-admissions">
        <div class="container">
            <h2><?php echo esc_html__( 'Latest Admissions', 'alljobassam-pro' ); ?></h2>
            <div class="jobs-grid grid-3">
                <?php
                $admissions = new WP_Query( array(
                    'post_type' => 'admission',
                    'posts_per_page' => 9,
                ) );

                if ( $admissions->have_posts() ) {
                    while ( $admissions->have_posts() ) {
                        $admissions->the_post();
                        get_template_part( 'template-parts/card-item' );
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- SECTION 10: SCHOLARSHIPS -->
    <section class="section-scholarships">
        <div class="container">
            <h2><?php echo esc_html__( 'Latest Scholarships', 'alljobassam-pro' ); ?></h2>
            <div class="jobs-grid grid-3">
                <?php
                $scholarships = new WP_Query( array(
                    'post_type' => 'scholarship',
                    'posts_per_page' => 9,
                ) );

                if ( $scholarships->have_posts() ) {
                    while ( $scholarships->have_posts() ) {
                        $scholarships->the_post();
                        get_template_part( 'template-parts/card-item' );
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- SECTION 11: NEWSLETTER -->
    <section class="section-newsletter">
        <div class="container">
            <div class="newsletter-box">
                <h2><?php echo esc_html__( 'Subscribe to Our Newsletter', 'alljobassam-pro' ); ?></h2>
                <p><?php echo esc_html__( 'Get latest job updates directly to your inbox', 'alljobassam-pro' ); ?></p>
                <form class="newsletter-form">
                    <input type="email" placeholder="<?php echo esc_attr__( 'Your Email', 'alljobassam-pro' ); ?>" required>
                    <button type="submit" class="btn btn-primary"><?php echo esc_html__( 'Subscribe', 'alljobassam-pro' ); ?></button>
                </form>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
