<?php
    // @package portfolioMrMas
?>

<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="container">
            <?php 
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    get_template_part('template-parts/content', get_post_format());
                }

                // Add styled pagination here
                echo '<div class="pagination-wrapper">';
                the_posts_pagination([
                    'mid_size' => 2,
                    'prev_text' => __('« Previous', 'portfolioMrMas'),
                    'next_text' => __('Next »', 'portfolioMrMas'),
                    'screen_reader_text' => __('Posts navigation', 'portfolioMrMas'),
                ]);
                echo '</div>';
            } else {
                echo '<p>' . __('No posts found.', 'portfolioMrMas') . '</p>';
            }
            ?>
        </div>
    </main>
</div>

<?php get_footer(); ?>
