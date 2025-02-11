<?php

/* @package portfolioMrMas */

/* ============== Theme Custom Post Type ============== */


$contact = get_option('activate_contact');
if (isset($contact) && $contact == 1) {
    add_action('init', 'portfolioMrMas_contact_custom_post_type');

    add_filter('manage_contactcpt_posts_columns', 'portfolioMrMas_set_contact_columns');
    add_action('manage_contactcpt_posts_custom_column', 'portfolioMrMas_contact_custom_column', 10, 2);

    add_action('add_meta_boxes', 'portfolioMrMas_contact_add_meta_box');
    add_action('save_post', 'portfolioMrMas_save_contact_email_data');
}

/*  Contact CPT */
function portfolioMrMas_contact_custom_post_type()
{
    $labels = array(
        'name'              => 'Messages',
        'singular_name'     => 'Message',
        'menu_name'         => 'Messages',
        'name_admin_bar'    => 'Message',
    );

    $args = array(
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'menu_position'     => 26,
        'menu_icon'         => 'dashicons-email',
        'supports'          => array('title', 'editor', 'author')
    );

    register_post_type('contactcpt', $args);
}

function portfolioMrMas_set_contact_columns($columns)
{
    $newColumns = array(
        'title'     => 'Full Name',
        'message'   => 'Message',
        'email'     => 'Email',
        'phone'     => 'Phone',
        'date'      => 'Date'
    );
    return $newColumns;
}

function portfolioMrMas_contact_custom_column($column, $post_id)
{
    switch ($column) {
        case 'email':
            $email = get_post_meta($post_id, '_contact_email_value_key', true);
            echo '<a href="' . $email . '" >' . $email . '</a>';
            break;

        case 'message':
            echo get_the_excerpt($post_id);
            break;
    }
}

//  Contact Meta Boxes 
function portfolioMrMas_contact_add_meta_box()
{
    add_meta_box('contact-email', 'User Email', 'portfolioMrMas_contact_email_callback', 'contactcpt', 'side');
}

function portfolioMrMas_contact_email_callback($post)
{
    wp_nonce_field('portfolioMrMas_save_contact_email_data', 'portfolioMrMas_contact_email_meta_box_nonce');

    $value = get_post_meta($post->ID, '_contact_email_value_key', true);

    echo '<label for="portfolioMrMas_contact_email_field">User Email Adress: </label>';
    echo '<input type="email" id="portfolioMrMas_contact_email_field" name="portfolioMrMas_contact_email_field" value="' . esc_attr($value) . '" size="25" />';
}

function portfolioMrMas_save_contact_email_data($post_id)
{

    if (!isset($_POST['portfolioMrMas_contact_email_meta_box_nonce'])) {
        return;
    }

    if (! wp_verify_nonce($_POST['portfolioMrMas_contact_email_meta_box_nonce'], 'portfolioMrMas_save_contact_email_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (! current_user_can('edit_post', $post_id)) {
        return;
    }

    if (! isset($_POST['portfolioMrMas_contact_email_field'])) {
        return;
    }

    $my_data = sanitize_text_field($_POST['portfolioMrMas_contact_email_field']);

    update_post_meta($post_id, '_contact_email_value_key', $my_data);
}
