<?php
/**
 * AllJobAssam Pro - Functions File
 * 
 * @package AllJobAssam_Pro
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Define theme constants
define( 'ALLJOBASSAM_VERSION', '1.0.0' );
define( 'ALLJOBASSAM_DIR', get_template_directory() );
define( 'ALLJOBASSAM_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function alljobassam_setup() {
    // Load text domain
    load_theme_textdomain( 'alljobassam-pro', ALLJOBASSAM_DIR . '/languages' );

    // Add theme support
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style'
    ) );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'appearance-tools' );
    
    // Add image sizes
    add_image_size( 'alljobassam-hero', 1920, 600, true );
    add_image_size( 'alljobassam-card', 400, 300, true );
    add_image_size( 'alljobassam-thumb', 150, 150, true );

    // Register menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'alljobassam-pro' ),
        'footer' => __( 'Footer Menu', 'alljobassam-pro' ),
        'mobile' => __( 'Mobile Menu', 'alljobassam-pro' ),
    ) );
}
add_action( 'after_setup_theme', 'alljobassam_setup' );

/**
 * Register Scripts and Styles
 */
function alljobassam_scripts() {
    // CSS
    wp_enqueue_style( 'alljobassam-style', ALLJOBASSAM_URI . '/style.css', array(), ALLJOBASSAM_VERSION );
    wp_enqueue_style( 'alljobassam-responsive', ALLJOBASSAM_URI . '/responsive.css', array(), ALLJOBASSAM_VERSION );
    wp_enqueue_style( 'alljobassam-components', ALLJOBASSAM_URI . '/assets/css/components.css', array(), ALLJOBASSAM_VERSION );
    
    // Google Fonts
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap', array(), null );

    // JavaScript
    wp_enqueue_script( 'alljobassam-main', ALLJOBASSAM_URI . '/assets/js/main.js', array(), ALLJOBASSAM_VERSION, true );
    wp_enqueue_script( 'alljobassam-ajax', ALLJOBASSAM_URI . '/assets/js/ajax.js', array( 'jquery' ), ALLJOBASSAM_VERSION, true );

    // Localize AJAX
    wp_localize_script( 'alljobassam-ajax', 'alljobassamAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'alljobassam_nonce' ),
    ) );

    // Comment script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'alljobassam_scripts' );

/**
 * Register Sidebar
 */
function alljobassam_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Primary Sidebar', 'alljobassam-pro' ),
        'id' => 'primary-sidebar',
        'description' => __( 'Main sidebar', 'alljobassam-pro' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Column 1', 'alljobassam-pro' ),
        'id' => 'footer-1',
        'description' => __( 'Footer column 1', 'alljobassam-pro' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Column 2', 'alljobassam-pro' ),
        'id' => 'footer-2',
        'description' => __( 'Footer column 2', 'alljobassam-pro' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Column 3', 'alljobassam-pro' ),
        'id' => 'footer-3',
        'description' => __( 'Footer column 3', 'alljobassam-pro' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Column 4', 'alljobassam-pro' ),
        'id' => 'footer-4',
        'description' => __( 'Footer column 4', 'alljobassam-pro' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ) );
}
add_action( 'widgets_init', 'alljobassam_widgets_init' );

/**
 * Custom Post Types
 */
function alljobassam_register_post_types() {
    // Jobs Post Type
    register_post_type( 'job', array(
        'labels' => array(
            'name' => __( 'Jobs', 'alljobassam-pro' ),
            'singular_name' => __( 'Job', 'alljobassam-pro' ),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite' => array( 'slug' => 'job' ),
        'menu_icon' => 'dashicons-briefcase',
    ) );

    // Results Post Type
    register_post_type( 'result', array(
        'labels' => array(
            'name' => __( 'Results', 'alljobassam-pro' ),
            'singular_name' => __( 'Result', 'alljobassam-pro' ),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite' => array( 'slug' => 'result' ),
        'menu_icon' => 'dashicons-list-view',
    ) );

    // Admit Cards Post Type
    register_post_type( 'admit_card', array(
        'labels' => array(
            'name' => __( 'Admit Cards', 'alljobassam-pro' ),
            'singular_name' => __( 'Admit Card', 'alljobassam-pro' ),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite' => array( 'slug' => 'admit-card' ),
        'menu_icon' => 'dashicons-id-alt',
    ) );

    // Admissions Post Type
    register_post_type( 'admission', array(
        'labels' => array(
            'name' => __( 'Admissions', 'alljobassam-pro' ),
            'singular_name' => __( 'Admission', 'alljobassam-pro' ),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite' => array( 'slug' => 'admission' ),
        'menu_icon' => 'dashicons-graduation',
    ) );

    // Scholarships Post Type
    register_post_type( 'scholarship', array(
        'labels' => array(
            'name' => __( 'Scholarships', 'alljobassam-pro' ),
            'singular_name' => __( 'Scholarship', 'alljobassam-pro' ),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite' => array( 'slug' => 'scholarship' ),
        'menu_icon' => 'dashicons-money-alt',
    ) );

    // Study Materials Post Type
    register_post_type( 'study_material', array(
        'labels' => array(
            'name' => __( 'Study Materials', 'alljobassam-pro' ),
            'singular_name' => __( 'Study Material', 'alljobassam-pro' ),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite' => array( 'slug' => 'study-material' ),
        'menu_icon' => 'dashicons-book',
    ) );

    // Current Affairs Post Type
    register_post_type( 'current_affair', array(
        'labels' => array(
            'name' => __( 'Current Affairs', 'alljobassam-pro' ),
            'singular_name' => __( 'Current Affair', 'alljobassam-pro' ),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite' => array( 'slug' => 'current-affairs' ),
        'menu_icon' => 'dashicons-calendar-alt',
    ) );
}
add_action( 'init', 'alljobassam_register_post_types' );

/**
 * Custom Taxonomies
 */
function alljobassam_register_taxonomies() {
    // Job Category
    register_taxonomy( 'job_category', 'job', array(
        'labels' => array(
            'name' => __( 'Job Categories', 'alljobassam-pro' ),
            'singular_name' => __( 'Job Category', 'alljobassam-pro' ),
        ),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array( 'slug' => 'job-category' ),
    ) );

    // Job Type
    register_taxonomy( 'job_type', 'job', array(
        'labels' => array(
            'name' => __( 'Job Types', 'alljobassam-pro' ),
            'singular_name' => __( 'Job Type', 'alljobassam-pro' ),
        ),
        'hierarchical' => false,
        'public' => true,
        'rewrite' => array( 'slug' => 'job-type' ),
    ) );

    // State
    register_taxonomy( 'state', array( 'job', 'admission', 'scholarship' ), array(
        'labels' => array(
            'name' => __( 'States', 'alljobassam-pro' ),
            'singular_name' => __( 'State', 'alljobassam-pro' ),
        ),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array( 'slug' => 'state' ),
    ) );

    // Department
    register_taxonomy( 'department', 'job', array(
        'labels' => array(
            'name' => __( 'Departments', 'alljobassam-pro' ),
            'singular_name' => __( 'Department', 'alljobassam-pro' ),
        ),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array( 'slug' => 'department' ),
    ) );
}
add_action( 'init', 'alljobassam_register_taxonomies' );

/**
 * Body Class
 */
function alljobassam_body_class( $classes ) {
    if ( is_front_page() ) {
        $classes[] = 'home-page';
    }
    if ( is_single() ) {
        $classes[] = 'single-post';
    }
    return $classes;
}
add_filter( 'body_class', 'alljobassam_body_class' );

/**
 * AJAX Search Handler
 */
function alljobassam_ajax_search() {
    check_ajax_referer( 'alljobassam_nonce', 'nonce' );

    $search = sanitize_text_field( $_POST['search'] ?? '' );

    if ( strlen( $search ) < 2 ) {
        wp_send_json_error( 'Minimum 2 characters required' );
    }

    $args = array(
        's' => $search,
        'post_type' => array( 'job', 'admission', 'scholarship', 'study_material' ),
        'posts_per_page' => 10,
    );

    $query = new WP_Query( $args );
    $results = array();

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $results[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'url' => get_permalink(),
                'type' => get_post_type(),
            );
        }
    }

    wp_reset_postdata();
    wp_send_json_success( $results );
}
add_action( 'wp_ajax_alljobassam_search', 'alljobassam_ajax_search' );
add_action( 'wp_ajax_nopriv_alljobassam_search', 'alljobassam_ajax_search' );

/**
 * AJAX Load More Handler
 */
function alljobassam_ajax_load_more() {
    check_ajax_referer( 'alljobassam_nonce', 'nonce' );

    $paged = intval( $_POST['paged'] ?? 1 );
    $post_type = sanitize_text_field( $_POST['post_type'] ?? 'job' );

    $args = array(
        'post_type' => $post_type,
        'paged' => $paged,
        'posts_per_page' => 12,
    );

    $query = new WP_Query( $args );
    $html = '';

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            ob_start();
            get_template_part( 'template-parts/job-card' );
            $html .= ob_get_clean();
        }
    }

    wp_reset_postdata();
    wp_send_json_success( array(
        'html' => $html,
        'max_pages' => $query->max_num_pages,
    ) );
}
add_action( 'wp_ajax_alljobassam_load_more', 'alljobassam_ajax_load_more' );
add_action( 'wp_ajax_nopriv_alljobassam_load_more', 'alljobassam_ajax_load_more' );

/**
 * Custom Query for Closing Jobs
 */
function alljobassam_get_closing_jobs( $days = 0 ) {
    $today = current_time( 'Y-m-d' );
    $closing_date = date( 'Y-m-d', strtotime( "+{$days} days" ) );

    $args = array(
        'post_type' => 'job',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'last_date',
                'value' => array( $today, $closing_date ),
                'compare' => 'BETWEEN',
                'type' => 'DATE',
            ),
        ),
    );

    return new WP_Query( $args );
}

/**
 * Output Buffer for better performance
 */
if ( ! is_admin() ) {
    ob_start( 'ob_gzhandler' );
}

/**
 * Disable unnecessary features for performance
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );

/**
 * Schema Output
 */
function alljobassam_schema() {
    if ( is_front_page() ) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => get_bloginfo( 'name' ),
            'url' => home_url(),
            'potentialAction' => array(
                '@type' => 'SearchAction',
                'target' => array(
                    '@type' => 'EntryPoint',
                    'urlTemplate' => home_url( '/?s={search_term_string}' ),
                ),
                'query-input' => 'required name=search_term_string',
            ),
        );

        echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>';
    }
}
add_action( 'wp_head', 'alljobassam_schema' );
