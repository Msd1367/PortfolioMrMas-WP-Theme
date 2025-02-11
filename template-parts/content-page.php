<?php
// @package portfolioMrMas
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/BlogPosting">
    <header class="entry-header text-center">
        <?php
        // Display the post title
        the_title(
            '<h1 class="entry-title" itemprop="headline"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">',
            '</a></h1>'
        );

        // Display the post metadata
        ?>

    </header>

    <div class="entry-content" itemprop="articleBody">
        <?php
        // Display the post content
        the_content();
        ?>
    </div>


</article>