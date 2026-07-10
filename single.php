<?php
/**
 * Single post template
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
                while ( have_posts() ) {
                    the_post();
                    ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>
                        
                        <!-- Breadcrumb -->
                        <nav class="breadcrumb">
                            <a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html__( 'Home', 'alljobassam-pro' ); ?></a>
                            <span>/</span>
                            <a href="<?php echo esc_url( get_post_type_archive_link( get_post_type() ) ); ?>">
                                <?php echo esc_html( get_post_type_object( get_post_type() )->labels->name ); ?>
                            </a>
                            <span>/</span>
                            <span><?php the_title(); ?></span>
                        </nav>

                        <!-- Featured Image -->
                        <?php
                        if ( has_post_thumbnail() ) {
                            ?>
                            <figure class="featured-image">
                                <?php the_post_thumbnail( 'alljobassam-hero' ); ?>
                            </figure>
                            <?php
                        }
                        ?>

                        <!-- Post Header -->
                        <header class="post-header">
                            <h1><?php the_title(); ?></h1>
                            
                            <div class="post-meta">
                                <span class="post-date">
                                    <i class="icon-calendar"></i>
                                    <?php echo esc_html( get_the_date() ); ?>
                                </span>
                                <span class="post-author">
                                    <i class="icon-user"></i>
                                    <?php the_author_posts_link(); ?>
                                </span>
                                <span class="post-views">
                                    <i class="icon-eye"></i>
                                    <?php echo esc_html( get_post_meta( get_the_ID(), 'views', true ) ?: '0' ); ?> <?php echo esc_html__( 'Views', 'alljobassam-pro' ); ?>
                                </span>
                                <span class="reading-time">
                                    <i class="icon-clock"></i>
                                    <?php echo esc_html( alljobassam_reading_time() ); ?> <?php echo esc_html__( 'min read', 'alljobassam-pro' ); ?>
                                </span>
                            </div>
                        </header>

                        <!-- Share Buttons -->
                        <div class="share-buttons">
                            <span><?php echo esc_html__( 'Share:', 'alljobassam-pro' ); ?></span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="btn-share facebook">Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( get_permalink() ); ?>&text=<?php echo esc_attr( get_the_title() ); ?>" target="_blank" class="btn-share twitter">Twitter</a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="btn-share linkedin">LinkedIn</a>
                        </div>

                        <!-- Post Content -->
                        <div class="post-content">
                            <?php the_content(); ?>
                        </div>

                        <!-- Job-specific Actions -->
                        <?php
                        if ( 'job' === get_post_type() ) {
                            $apply_link = get_post_meta( get_the_ID(), 'apply_link', true );
                            $official_site = get_post_meta( get_the_ID(), 'official_website', true );
                            $pdf_url = get_post_meta( get_the_ID(), 'notification_pdf', true );
                            ?>
                            <div class="job-actions">
                                <?php if ( $apply_link ) : ?>
                                    <a href="<?php echo esc_url( $apply_link ); ?>" target="_blank" class="btn btn-primary btn-lg">
                                        <?php echo esc_html__( 'Apply Online', 'alljobassam-pro' ); ?>
                                    </a>
                                <?php endif; ?>

                                <?php if ( $official_site ) : ?>
                                    <a href="<?php echo esc_url( $official_site ); ?>" target="_blank" class="btn btn-secondary btn-lg">
                                        <?php echo esc_html__( 'Official Website', 'alljobassam-pro' ); ?>
                                    </a>
                                <?php endif; ?>

                                <?php if ( $pdf_url ) : ?>
                                    <a href="<?php echo esc_url( $pdf_url ); ?>" target="_blank" class="btn btn-secondary btn-lg">
                                        <?php echo esc_html__( 'Download PDF', 'alljobassam-pro' ); ?>
                                    </a>
                                <?php endif; ?>

                                <button onclick="window.print()" class="btn btn-secondary btn-lg">
                                    <?php echo esc_html__( 'Print', 'alljobassam-pro' ); ?>
                                </button>
                            </div>
                            <?php
                        }
                        ?>

                        <!-- FAQ -->
                        <?php
                        $faq = get_post_meta( get_the_ID(), 'faq', true );
                        if ( $faq && is_array( $faq ) ) {
                            ?>
                            <div class="faq-section">
                                <h3><?php echo esc_html__( 'Frequently Asked Questions', 'alljobassam-pro' ); ?></h3>
                                <div class="faq-list">
                                    <?php foreach ( $faq as $item ) : ?>
                                        <div class="faq-item">
                                            <button class="faq-question"><?php echo esc_html( $item['question'] ); ?></button>
                                            <div class="faq-answer">
                                                <?php echo wp_kses_post( $item['answer'] ); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <!-- Related Posts -->
                        <div class="related-posts">
                            <h3><?php echo esc_html__( 'Related Posts', 'alljobassam-pro' ); ?></h3>
                            <div class="posts-grid grid-3">
                                <?php
                                $related = new WP_Query( array(
                                    'post_type' => get_post_type(),
                                    'posts_per_page' => 3,
                                    'post__not_in' => array( get_the_ID() ),
                                    'orderby' => 'rand',
                                ) );

                                if ( $related->have_posts() ) {
                                    while ( $related->have_posts() ) {
                                        $related->the_post();
                                        get_template_part( 'template-parts/card-item' );
                                    }
                                }
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>

                    </article>

                    <?php
                    // Comments
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
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

/**
 * Calculate reading time
 */
function alljobassam_reading_time() {
    $post_content = get_the_content();
    $word_count = str_word_count( strip_tags( $post_content ) );
    $reading_time = ceil( $word_count / 200 );
    return $reading_time;
}
