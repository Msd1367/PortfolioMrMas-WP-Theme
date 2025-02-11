<?php
// @package portfolioMrMas

// ----------- Link Post Format -----------
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header text-center">
        <?php the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>'); ?>
        <div class="entry-meta">
            <?php echo portfolioMrMas_posted_meta(); ?>
        </div>
    </header>

    <div class="entry-content text-center">
        <?php the_content(); ?>
        
        <?php
        $link = get_post_meta(get_the_ID(), '_portfolioMrMas_link_url', true);
        if ($link): ?>
            <div class="embed-link text-center">
                <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener noreferrer">
                    <div class="link-box">
                        <i class="fa fa-link"></i> <?php echo esc_html($link); ?>
                    </div>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <footer class="entry-footer">
        <?php echo portfolioMrMas_posted_footer(); ?>
    </footer>

</article>