<?php
/**
 * Search results template
 * 
 * @package AllJobAssam_Pro
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <!-- Search Header -->
        <header class="search-header">
            <h1>
                <?php
                printf(
                    esc_html__( 'Search Results for: %s', 'alljobassam-pro' ),
                    '<span>' . esc_html( get_search_query() ) . '</span>'
                );
                ?>
            </h1>
            <p><?php printf( esc_html__( 'Found %d results', 'alljobassam-pro' ), $GLOBALS['wp_query']->found_posts ); ?></p>
        </header>

        <div class="row">
            <div class="col-main">
                <!-- Search Form -->
                <form class="search-form mb-4" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr__( 'Search...', 'alljobassam-pro' ); ?>">
                    <button type="submit" class="btn btn-primary"><?php echo esc_html__( 'Search', 'alljobassam-pro' ); ?></button>
                </form>

                <!-- Results -->
                <div class="search-results">
                    <?php
                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();
                            ?>
                            <article class="search-result">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p class="result-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 55 ); ?></p>
                                <div class="result-meta">
                                    <span class="result-date"><?php echo esc_html( get_the_date() ); ?></span>
                                    <span class="result-type"><?php echo esc_html( get_post_type() ); ?></span>
                                </div>
                            </article>
                            <?php
                        }
                    } else {
                        get_template_part( 'template-parts/content', 'none' );
                    }
                    ?>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper mt-4">
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
