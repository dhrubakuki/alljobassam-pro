<?php
/**
 * Main index.php template
 * 
 * @package AllJobAssam_Pro
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="row">
            <div class="col-main">
                <?php
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        get_template_part( 'template-parts/post', get_post_type() );
                    }

                    // Pagination
                    the_posts_pagination( array(
                        'prev_text' => __( 'Previous', 'alljobassam-pro' ),
                        'next_text' => __( 'Next', 'alljobassam-pro' ),
                        'class' => 'pagination',
                    ) );
                } else {
                    get_template_part( 'template-parts/content', 'none' );
                }
                ?>
            </div>

            <aside class="col-sidebar">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</main>

<?php
get_footer();
