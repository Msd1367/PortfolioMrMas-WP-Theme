<?php

/* @package portfolioMrMas */

/* ============== Theme Support Options ============== */
$saved_formats = get_option('post_formats', array());
$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
$output = array();

if (!empty($saved_formats)) {
    foreach ($formats as $format) {
        if (isset($saved_formats[$format]) && $saved_formats[$format] == 1) {
            $output[] = $format;
        }
    }

    if (!empty($output)) {
        add_theme_support('post-formats', $output);
    }
}

$header = get_option('custom_header');
if (isset($header) && $header == 1) {
    add_theme_support('custom-header');
}

$backgroung = get_option('custom_background');
if (isset($backgroung) && $backgroung == 1) {
    add_theme_support('custom-background');
}

add_theme_support('post-thumbnails');

// Activate Nav Menu Option
function portfolioMrMas_register_nav_menu()
{
    register_nav_menu('primary', 'Header Navigation Menu');
}
add_action('after_setup_theme', 'portfolioMrMas_register_nav_menu');

// Register Sidebar
function portfolioMrMas_widgets_init() {
    register_sidebar(array(
        'name'          => __('PortfolioMrMas Sidebar', 'portfolioMrMas'),
        'id'            => 'sidebar-right',
        'description'   => __('Add widgets here to appear in your sidebar.', 'portfolioMrMas'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'portfolioMrMas_widgets_init');

// BLOG LOOP CUSTOM FUNCTIONS 
function portfolioMrMas_posted_meta()
{
    $posted_on = human_time_diff(get_the_time('U'), current_time('timestamp'));

    $categories = get_the_category();
    $separator = ', ';
    $output = '';
    $i = 1;

    if (!empty($categories)):
        foreach ($categories as $category):
            if ($i > 1): $output .= $separator;
            endif;
            $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" alt="' . esc_attr('View all posts in%s', $category->name) . '">' . esc_html($category->name) . '</a>';
            $i++;
        endforeach;
    endif;

    return '<span class="posted-on">Posted <a href="' . esc_url(get_permalink()) . '">' . $posted_on . '</a> ago</span> / Categories: <span class="posted-in">' . $output . '</span>';
}

function portfolioMrMas_posted_footer()
{
    $comments_num = get_comments_number();
    if (comments_open()) {
        if ($comments_num == 0) {
            $comments = __('No Comments');
        } elseif ($comments_num > 1) {
            $comments = $comments_num . __(' Comments');
        } else {
            $comments = __('1 Comment');
        }
        $comments = '<a class="comments-link" href="' . get_comments_link() . '">' . $comments . ' <span class="portfolioMrMas-icon portfolioMrMas-comment"></span></a>';
    } else {
        $comments = __('Comments are closed');
    }

    return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">' . get_the_tag_list('<div class="tags-list"><span class="portfolioMrMas-icon portfolioMrMas-tag">Tags: </span>', ' ', '</div>') . '</div><div class="col-xs-12 col-sm-6 text-end">' . $comments . '</div></div></div>';
}

function portfolioMrMas_get_attachment() {
    $output = '';

    // Check for featured image (post thumbnail)
    if (has_post_thumbnail()) {
        $output = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
    } else {
        // Check for attached images using get_attached_media()
        $attachments = get_attached_media('image', get_the_ID());

        if (!empty($attachments)) {
            $first_attachment = reset($attachments); // Get the first attachment
            $output = wp_get_attachment_url($first_attachment->ID);
        } else {
            // Look for images in the post content
            $post_content = get_the_content();
            preg_match('/<img[^>]+src=["\']([^"\']+)["\']/', $post_content, $matches);

            if (!empty($matches[1])) {
                $output = $matches[1]; // The first captured group is the image URL
            }
        }
    }

    return $output;
}


function portfolioMrMas_add_gallery_metabox() {
    add_meta_box('gallery_metabox', 'Gallery Images', 'portfolioMrMas_gallery_metabox_callback', 'gallery', 'normal', 'high');
}

function portfolioMrMas_gallery_metabox_callback($post) {
    $gallery_images = get_post_meta($post->ID, 'gallery_images', true);
    $gallery_images = is_string($gallery_images) ? json_decode($gallery_images, true) : $gallery_images;

    echo '<div id="gallery-images-container">';
    if (!empty($gallery_images)) {
        foreach ($gallery_images as $image_url) {
            echo '<div class="gallery-image-item">';
            echo '<input type="text" name="gallery_images[]" value="' . esc_url($image_url) . '" class="widefat" />';
            echo '</div>';
        }
    }
    echo '</div>';

    echo '<button type="button" id="add-gallery-image" class="button">Add Image</button>';
}
add_action('add_meta_boxes', 'portfolioMrMas_add_gallery_metabox');

function portfolioMrMas_save_gallery_meta($post_id) {
    if (isset($_POST['gallery_images'])) {
        $images = array_filter($_POST['gallery_images']);
        update_post_meta($post_id, 'gallery_images', json_encode($images));
    }
}
add_action('save_post', 'portfolioMrMas_save_gallery_meta');

