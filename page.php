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
                    get_template_part('template-parts/content', 'page');
                }
            } else {
                get_template_part('template-parts/content', 'none');
            }
            ?>
        </div>
    </main>
</div>

<?php get_footer(); ?>
