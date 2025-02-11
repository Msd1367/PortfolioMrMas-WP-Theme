<?php
// @package portfolioMrMas
?>

<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="container">
            <div id="post-container">

                <?php
                // Initial WP_Query to load first set of posts
                $query = new WP_Query([
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                ]);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        get_template_part('template-parts/content', get_post_format());
                    }

                    wp_reset_postdata();
                } else {
                    echo '<div class="text-center p-5 border-rounded bg-info"><p>' . __('No posts found.', 'portfolioMrMas') . '</p></div>';
                }
                ?>
            </div>
        </div>

        <div id="load-more-container">
            <button id="load-more" data-page="1">Load More</button>
        </div>
    </main>
</div>

<?php get_footer(); ?>
