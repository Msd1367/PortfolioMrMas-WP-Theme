<?php
/* @package portfolioMrMas */

function portfolioMrMas_load_more_posts() {
    // Get the page number from the AJAX request
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;

    // Query posts
    $query = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => 3,
        'paged' => $page, // use the correct page
    ]);

    // Output posts
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', get_post_format());
        }

        wp_reset_postdata();
    } else {
        echo 'no_more_posts'; // send 'no_more_posts' if no posts are found
    }

    wp_die();
}

add_action('wp_ajax_load_more_posts', 'portfolioMrMas_load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'portfolioMrMas_load_more_posts');
