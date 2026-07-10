<?php
/**
 * Header template
 * 
 * @package AllJobAssam_Pro
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- Skip to Main Content Link -->
    <a href="#primary" class="skip-to-content"><?php echo esc_html__( 'Skip to main content', 'alljobassam-pro' ); ?></a>

    <!-- Notification Bar -->
    <div class="notification-bar">
        <div class="container">
            <div class="notification-content">
                <span class="notification-label"><?php echo esc_html__( 'Breaking News:', 'alljobassam-pro' ); ?></span>
                <marquee><?php echo esc_html__( 'Latest job updates and recruitment notifications', 'alljobassam-pro' ); ?></marquee>
            </div>
        </div>
    </div>

    <!-- Top Header -->
    <div class="top-header">
        <div class="container">
            <div class="top-header-content flex-between">
                <div class="top-left">
                    <ul class="top-menu">
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__( 'Home', 'alljobassam-pro' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php echo esc_html__( 'About', 'alljobassam-pro' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php echo esc_html__( 'Contact', 'alljobassam-pro' ); ?></a></li>
                    </ul>
                </div>
                <div class="top-right">
                    <button class="theme-toggle" id="theme-toggle" aria-label="<?php echo esc_attr__( 'Toggle Dark Mode', 'alljobassam-pro' ); ?>">
                        <i class="icon-moon"></i>
                    </button>
                    <a href="#" class="btn btn-sm"><?php echo esc_html__( 'Login', 'alljobassam-pro' ); ?></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header id="masthead" class="site-header sticky-header">
        <div class="container">
            <div class="header-content flex-between">
                <!-- Logo -->
                <div class="site-branding">
                    <?php
                    if ( has_custom_logo() ) {
                        the_custom_logo();
                    } else {
                        ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                <?php bloginfo( 'name' ); ?>
                            </a>
                        </h1>
                        <?php
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description ) {
                            ?>
                            <p class="site-description"><?php echo esc_html( $description ); ?></p>
                            <?php
                        }
                    }
                    ?>
                </div>

                <!-- Navigation -->
                <nav id="site-navigation" class="main-navigation" aria-label="<?php echo esc_attr__( 'Primary Menu', 'alljobassam-pro' ); ?>">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class' => 'menu',
                        'container' => false,
                        'fallback_cb' => 'wp_page_menu',
                    ) );
                    ?>
                </nav>

                <!-- Header Search -->
                <div class="header-search">
                    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form-header">
                        <input type="search" name="s" placeholder="<?php echo esc_attr__( 'Search jobs...', 'alljobassam-pro' ); ?>" class="search-input">
                        <button type="submit" class="search-btn"><i class="icon-search"></i></button>
                    </form>
                </div>

                <!-- WhatsApp Button -->
                <a href="https://wa.me/919999999999" target="_blank" class="btn btn-primary btn-whatsapp">
                    <i class="icon-whatsapp"></i>
                    <?php echo esc_html__( 'WhatsApp', 'alljobassam-pro' ); ?>
                </a>

                <!-- Mobile Menu Toggle -->
                <button class="menu-toggle" aria-expanded="false" aria-controls="site-navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <!-- Mega Menu -->
            <div class="mega-menu">
                <div class="mega-menu-content">
                    <div class="mega-menu-column">
                        <h4><?php echo esc_html__( 'Government Jobs', 'alljobassam-pro' ); ?></h4>
                        <ul>
                            <li><a href="<?php echo esc_url( home_url( '/job-category/central-govt' ) ); ?>"><?php echo esc_html__( 'Central Govt', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/job-category/assam-govt' ) ); ?>"><?php echo esc_html__( 'Assam Govt', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/job-category/railway' ) ); ?>"><?php echo esc_html__( 'Railway', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/job-category/bank' ) ); ?>"><?php echo esc_html__( 'Bank', 'alljobassam-pro' ); ?></a></li>
                        </ul>
                    </div>

                    <div class="mega-menu-column">
                        <h4><?php echo esc_html__( 'Other Opportunities', 'alljobassam-pro' ); ?></h4>
                        <ul>
                            <li><a href="<?php echo esc_url( home_url( '/result' ) ); ?>"><?php echo esc_html__( 'Results', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/admit-card' ) ); ?>"><?php echo esc_html__( 'Admit Cards', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/admission' ) ); ?>"><?php echo esc_html__( 'Admissions', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/scholarship' ) ); ?>"><?php echo esc_html__( 'Scholarships', 'alljobassam-pro' ); ?></a></li>
                        </ul>
                    </div>

                    <div class="mega-menu-column">
                        <h4><?php echo esc_html__( 'Study Materials', 'alljobassam-pro' ); ?></h4>
                        <ul>
                            <li><a href="<?php echo esc_url( home_url( '/study-material' ) ); ?>"><?php echo esc_html__( 'PDF Notes', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/syllabus' ) ); ?>"><?php echo esc_html__( 'Syllabus', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/answer-key' ) ); ?>"><?php echo esc_html__( 'Answer Keys', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/previous-papers' ) ); ?>"><?php echo esc_html__( 'Previous Papers', 'alljobassam-pro' ); ?></a></li>
                        </ul>
                    </div>

                    <div class="mega-menu-column">
                        <h4><?php echo esc_html__( 'Resources', 'alljobassam-pro' ); ?></h4>
                        <ul>
                            <li><a href="<?php echo esc_url( home_url( '/current-affairs' ) ); ?>"><?php echo esc_html__( 'Current Affairs', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/gk' ) ); ?>"><?php echo esc_html__( 'GK', 'alljobassam-pro' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/schemes' ) ); ?>"><?php echo esc_html__( 'Govt Schemes', 'alljobassam-pro' ); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Scroll Progress Bar -->
    <div class="scroll-progress-bar"></div>
