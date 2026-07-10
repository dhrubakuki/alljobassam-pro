<?php
/**
 * Archive template
 * 
 * @package AllJobAssam_Pro
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <!-- Archive Header -->
        <header class="archive-header">
            <h1><?php the_archive_title(); ?></h1>
            <p><?php the_archive_description(); ?></p>
        </header>

        <div class="row">
            <div class="col-main">
                <!-- Filters & Sorting -->
                <div class="archive-controls">
                    <div class="filters">
                        <select id="sort-by" class="sort-select">
                            <option value="latest"><?php echo esc_html__( 'Latest', 'alljobassam-pro' ); ?></option>
                            <option value="oldest"><?php echo esc_html__( 'Oldest', 'alljobassam-pro' ); ?></option>
                            <option value="popular"><?php echo esc_html__( 'Most Popular', 'alljobassam-pro' ); ?></option>
                        </select>
                    </div>
                </div>

                <!-- Posts Grid -->
                <div class="posts-grid grid-3">
                    <?php
                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();
                            get_template_part( 'template-parts/card-item' );
                        }
                    } else {
                        get_template_part( 'template-parts/content', 'none' );
                    }
                    ?>
                </div>

                <!-- AJAX Pagination -->
                <div class="pagination-wrapper">
                    <?php
                    the_posts_pagination( array(
                        'prev_text' => __( '← Previous', 'alljobassam-pro' ),
                        'next_text' => __( 'Next →', 'alljobassam-pro' ),
                        'class' => 'pagination',
                    ) );
                    ?>
                </div>

                <!-- Load More Button -->
                <div class="text-center mt-4">
                    <button id="load-more" class="btn btn-primary" data-page="1">
                        <?php echo esc_html__( 'Load More', 'alljobassam-pro' ); ?>
                    </button>
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
