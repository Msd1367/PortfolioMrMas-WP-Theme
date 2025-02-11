<?php
// @package portfolioMrMas

// ----------- Gallery Post Format -----------
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('gallery-post'); ?>>
    <header class="entry-header text-center">
        <?php the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>'); ?>
        <div class="entry-meta">
            <?php echo portfolioMrMas_posted_meta(); ?>
        </div>
    </header>

    <div class="entry-content">
        <?php
        // Get the post content
        $content = get_the_content();

        // Extract all <img> tags from the content
        preg_match_all('/<img[^>]+>/i', $content, $matches);
        $images = $matches[0];

        if (!empty($images)) {
        ?>
            <div id="galleryCarousel-<?php the_ID(); ?>" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="hover">

                <!-- Carousel indicators -->
                <div class="carousel-indicators">
                    <?php foreach ($images as $index => $img_tag): ?>
                        <button type="button" data-bs-target="#galleryCarousel-<?php the_ID(); ?>" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>"></button>
                    <?php endforeach; ?>
                </div>

                <!-- Carousel slides -->
                <div class="carousel-inner">
                    <?php foreach ($images as $index => $img_tag): ?>
                        <?php
                        // Extract the src attribute from the <img> tag
                        preg_match('/src="([^"]+)"/i', $img_tag, $src_match);
                        $img_src = $src_match[1] ?? '';
                        ?>

                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <img src="<?php echo esc_url($img_src); ?>" class="d-block w-100 img-fluid" alt="Gallery Image <?php echo $index + 1; ?>">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Carousel controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel-<?php the_ID(); ?>" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel-<?php the_ID(); ?>" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        <?php } else { ?>
            <p>No images found in the content.</p>
        <?php } ?>
    </div>

    <footer class="entry-footer">
        <?php echo portfolioMrMas_posted_footer(); ?>
    </footer>

</article>