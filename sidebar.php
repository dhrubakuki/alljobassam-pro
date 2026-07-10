<?php
/**
 * Sidebar template
 * 
 * @package AllJobAssam_Pro
 */

?>

<aside id="secondary" class="sidebar primary-sidebar sticky-sidebar">
    
    <!-- Latest Jobs Widget -->
    <div class="sidebar-widget widget">
        <h3 class="widget-title"><?php echo esc_html__( 'Latest Jobs', 'alljobassam-pro' ); ?></h3>
        <div class="widget-content">
            <?php
            $latest_jobs = new WP_Query( array(
                'post_type' => 'job',
                'posts_per_page' => 5,
                'orderby' => 'date',
                'order' => 'DESC',
            ) );

            if ( $latest_jobs->have_posts() ) {
                echo '<ul class="jobs-list">';
                while ( $latest_jobs->have_posts() ) {
                    $latest_jobs->the_post();
                    $last_date = get_post_meta( get_the_ID(), 'last_date', true );
                    ?>
                    <li class="job-item">
                        <a href="<?php the_permalink(); ?>" class="job-link">
                            <strong><?php the_title(); ?></strong>
                            <?php if ( $last_date ) : ?>
                                <span class="job-date"><?php echo esc_html__( 'Closes: ', 'alljobassam-pro' ) . esc_html( date( 'd M Y', strtotime( $last_date ) ) ); ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <?php
                }
                echo '</ul>';
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>

    <!-- Popular Jobs Widget -->
    <div class="sidebar-widget widget">
        <h3 class="widget-title"><?php echo esc_html__( 'Popular Jobs', 'alljobassam-pro' ); ?></h3>
        <div class="widget-content">
            <?php
            $popular_jobs = new WP_Query( array(
                'post_type' => 'job',
                'posts_per_page' => 5,
                'orderby' => 'meta_value_num',
                'meta_key' => 'views',
                'order' => 'DESC',
            ) );

            if ( $popular_jobs->have_posts() ) {
                echo '<ul class="jobs-list">';
                while ( $popular_jobs->have_posts() ) {
                    $popular_jobs->the_post();
                    ?>
                    <li class="job-item">
                        <a href="<?php the_permalink(); ?>" class="job-link">
                            <strong><?php the_title(); ?></strong>
                            <span class="job-views"><?php echo esc_html__( 'Views: ', 'alljobassam-pro' ) . esc_html( get_post_meta( get_the_ID(), 'views', true ) ?: '0' ); ?></span>
                        </a>
                    </li>
                    <?php
                }
                echo '</ul>';
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>

    <!-- Latest Results Widget -->
    <div class="sidebar-widget widget">
        <h3 class="widget-title"><?php echo esc_html__( 'Latest Results', 'alljobassam-pro' ); ?></h3>
        <div class="widget-content">
            <?php
            $results = new WP_Query( array(
                'post_type' => 'result',
                'posts_per_page' => 5,
                'orderby' => 'date',
                'order' => 'DESC',
            ) );

            if ( $results->have_posts() ) {
                echo '<ul class="results-list">';
                while ( $results->have_posts() ) {
                    $results->the_post();
                    ?>
                    <li class="result-item">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
                    <?php
                }
                echo '</ul>';
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>

    <!-- Latest Admit Cards Widget -->
    <div class="sidebar-widget widget">
        <h3 class="widget-title"><?php echo esc_html__( 'Latest Admit Cards', 'alljobassam-pro' ); ?></h3>
        <div class="widget-content">
            <?php
            $admit_cards = new WP_Query( array(
                'post_type' => 'admit_card',
                'posts_per_page' => 5,
                'orderby' => 'date',
                'order' => 'DESC',
            ) );

            if ( $admit_cards->have_posts() ) {
                echo '<ul class="admit-list">';
                while ( $admit_cards->have_posts() ) {
                    $admit_cards->the_post();
                    ?>
                    <li class="admit-item">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
                    <?php
                }
                echo '</ul>';
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>

    <!-- Join Telegram Widget -->
    <div class="sidebar-widget widget cta-widget">
        <div class="cta-content">
            <h4><?php echo esc_html__( 'Join Telegram', 'alljobassam-pro' ); ?></h4>
            <p><?php echo esc_html__( 'Get instant job notifications', 'alljobassam-pro' ); ?></p>
            <a href="https://t.me/alljobassam" target="_blank" class="btn btn-primary btn-block">
                <i class="icon-telegram"></i> <?php echo esc_html__( 'Join Channel', 'alljobassam-pro' ); ?>
            </a>
        </div>
    </div>

    <!-- Join WhatsApp Widget -->
    <div class="sidebar-widget widget cta-widget">
        <div class="cta-content">
            <h4><?php echo esc_html__( 'Join WhatsApp', 'alljobassam-pro' ); ?></h4>
            <p><?php echo esc_html__( 'Daily updates on your WhatsApp', 'alljobassam-pro' ); ?></p>
            <a href="https://wa.me/919999999999" target="_blank" class="btn btn-success btn-block">
                <i class="icon-whatsapp"></i> <?php echo esc_html__( 'Join Group', 'alljobassam-pro' ); ?>
            </a>
        </div>
    </div>

    <!-- Ads Widget -->
    <div class="sidebar-widget widget ads-widget">
        <h3 class="widget-title"><?php echo esc_html__( 'Sponsored', 'alljobassam-pro' ); ?></h3>
        <div class="widget-content">
            <?php
            if ( is_active_sidebar( 'primary-sidebar' ) ) {
                dynamic_sidebar( 'primary-sidebar' );
            }
            ?>
        </div>
    </div>

</aside>
