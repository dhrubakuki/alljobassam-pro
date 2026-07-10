<?php
/**
 * Home (Blog) Page template
 * 
 * @package AllJobAssam_Pro
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <!-- Blog Header -->
        <header class="blog-header">
            <h1><?php echo esc_html__( 'Latest Articles', 'alljobassam-pro' ); ?></h1>
            <p><?php echo esc_html__( 'Stay updated with latest news and updates', 'alljobassam-pro' ); ?></p>
        </header>

        <div class="row">
            <div class="col-main">
                <!-- Posts Grid -->
                <div class="posts-grid grid-3">
                    <?php
                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();
                            get_template_part( 'template-parts/post-card' );
                        }
                    } else {
                        get_template_part( 'template-parts/content', 'none' );
                    }
                    ?>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <?php
                    the_posts_pagination( array(
                        'prev_text' => __( '← Previous', 'alljobassam-pro' ),
                        'next_text' => __( 'Next →', 'alljobassam-pro' ),
                        'class' => 'pagination',
                    ) );
                    ?>
                </div>
            </div>

            <aside class="col-sidebar">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</main>

<?php
get_footer();
