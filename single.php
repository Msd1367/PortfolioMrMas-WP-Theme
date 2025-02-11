<?php
// @package portfolioMrMas
?>

<?php get_header(); ?>

<div id="primary" class="content-area <?php echo esc_attr(join(' ', get_body_class())); ?>">
    <main id="main" class="site-main" role="main">
        <div class="container">
            <div class="row">
                <?php
                if (have_posts()) {
                    while (have_posts()) : the_post();
                        // Include the single post template part
                        get_template_part('template-parts/single', get_post_format());

                        // Track post views
                        portfolioMrMas_save_post_views(get_the_ID());
                    endwhile;

                    // Add navigation between posts
                    the_post_navigation(array(
                        'prev_text' => '<span>&laquo; Previous: %title</span>',
                        'next_text' => '<span>Next: %title &raquo;</span>',
                        'screen_reader_text' => __('Post navigation', 'portfolioMrMas'),
                    ));

                    // Include comments if enabled
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                } else {
                    echo '<p>' . __('No posts found.', 'portfolioMrMas') . '</p>';
                }
                ?>
            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>