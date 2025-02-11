<?php
// @package portfolioMrMas

// ----------- Standard Post Format -----------
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header text-center">
        <?php the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>'); ?>
        <div class="entry-meta">
            <?php echo portfolioMrMas_posted_meta(); ?>
        </div>
    </header>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>

    <footer class="entry-footer">
        <?php echo portfolioMrMas_posted_footer(); ?>
    </footer>

</article>