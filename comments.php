<?php

/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @package PortfolioMrMas
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if (1 === $comments_number) {
                printf(
                    _x('One comment on &ldquo;%s&rdquo;', 'comments title', 'portfolioMrMas'),
                    get_the_title()
                );
            } else {
                printf(
                    _nx(
                        '%1$s comments on &ldquo;%2$s&rdquo;',
                        '%1$s comments on &ldquo;%2$s&rdquo;',
                        $comments_number,
                        'comments title',
                        'portfolioMrMas'
                    ),
                    number_format_i18n($comments_number),
                    get_the_title()
                );
            }
            ?>
        </h2>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 64, // Increased avatar size for better visibility
            ));
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

        <?php if (!comments_open() && get_comments_number()) : ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'portfolioMrMas'); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    $fields = array(
        'author' =>
            '<div class="form-group"><label for="author">' . __('Name', 'portfolioMrMas') . '</label> <span class="required">*</span> <input id="author" name="author" type="text" class="form-control" value="' . esc_attr($commenter['comment_author']) . '" required="required" /></div>',

        'email' =>
            '<div class="form-group"><label for="email">' . __('Email', 'portfolioMrMas') . '</label> <span class="required">*</span> <input id="email" name="email" type="email" class="form-control" value="' . esc_attr($commenter['comment_author_email']) . '" required="required" /></div>',

        'url' =>
            '<div class="form-group"><label for="url">' . __('Website', 'portfolioMrMas') . '</label><input id="url" name="url" type="url" class="form-control" value="' . esc_attr($commenter['comment_author_url']) . '" /></div>',
    );

    $args = array(
        'fields'        => $fields,
        'comment_field' =>
            '<div class="form-group"><label for="comment">' . _x('Comment', 'noun') . '</label> <span class="required">*</span><textarea id="comment" name="comment" class="form-control no-resize" rows="4" required="required"></textarea></div>',
        'class_submit'  => 'btn btn-primary',
        'label_submit'  => __('Post Comment', 'portfolioMrMas'),
    );

    comment_form($args);
    ?>

</div><!-- .comments-area -->
