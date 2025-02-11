<?php

/* @package portfolioMrMas */

/* ============== ADMIN PAGE ============== */

function portfolioMrMas_add_admin_page()
{

    // Generate Admin Page
    add_menu_page('portfolioMrMas Theme Options', 'portfolioMrMas', 'manage_options', 'portfolioMrMas_options', 'portfolioMrMas_theme_create_page_callback', get_template_directory_uri() . '/image/portfolio_2_20x20.png', 110);

    // Generate Sub Pages
    add_submenu_page('portfolioMrMas_options', 'portfolioMrMas Sidebar Options', 'Sidebar', 'manage_options', 'portfolioMrMas_options', 'portfolioMrMas_theme_create_page_callback');
    add_submenu_page('portfolioMrMas_options', 'portfolioMrMas Theme Options', 'Theme Options', 'manage_options', 'portfolioMrMas_options_theme', 'portfolioMrMas_theme_support_page_callback');
    add_submenu_page('portfolioMrMas_options', 'portfolioMrMas Contact Form', 'Contact Options', 'manage_options', 'portfolioMrMas_options_contact', 'portfolioMrMas_theme_contact_page_callback');
    add_submenu_page('portfolioMrMas_options', 'portfolioMrMas CSS Options', 'Custom CSS', 'manage_options', 'portfolioMrMas_options_css', 'portfolioMrMas_theme_settings_page_callback');

    // Activate custom settings
    add_action('admin_init', 'portfolioMrMas_custom_settings');
}
add_action('admin_menu', 'portfolioMrMas_add_admin_page');

function portfolioMrMas_custom_settings()
{
    // Sidebar Options
    register_setting('portfolioMrMas-settings-group', 'profile_picture');
    register_setting('portfolioMrMas-settings-group', 'first_name', 'portfolioMrMas_saitize_input');
    register_setting('portfolioMrMas-settings-group', 'last_name', 'portfolioMrMas_saitize_input');
    register_setting('portfolioMrMas-settings-group', 'user_description', 'portfolioMrMas_saitize_input');
    register_setting('portfolioMrMas-settings-group', 'instagram', 'portfolioMrMas_saitize_input');
    register_setting('portfolioMrMas-settings-group', 'telegram', 'portfolioMrMas_saitize_input');
    register_setting('portfolioMrMas-settings-group', 'linkedin', 'portfolioMrMas_saitize_input');
    register_setting('portfolioMrMas-settings-group', 'github', 'portfolioMrMas_saitize_input');
    register_setting('portfolioMrMas-settings-group', 'email', 'portfolioMrMas_saitize_email');

    add_settings_section('portfolioMrMas-sidebar-options', 'Sidebar Options', 'portfolioMrMas_sidebar_options_section_callback', 'portfolioMrMas_options');

    add_settings_field('sidebar-profile-picture', 'Profile Picture', 'portfolioMrMas_sidebar_profile_picture_callback', 'portfolioMrMas_options', 'portfolioMrMas-sidebar-options');
    add_settings_field('sidebar-name', 'Full Name', 'portfolioMrMas_sidebar_name_callback', 'portfolioMrMas_options', 'portfolioMrMas-sidebar-options');
    add_settings_field('sidebar-user_description', 'User Description', 'portfolioMrMas_sidebar_user_description_callback', 'portfolioMrMas_options', 'portfolioMrMas-sidebar-options');
    add_settings_field('sidebar-instagram', 'Instagram', 'portfolioMrMas_sidebar_instagram_callback', 'portfolioMrMas_options', 'portfolioMrMas-sidebar-options');
    add_settings_field('sidebar-telegram', 'Telegram', 'portfolioMrMas_sidebar_telegram_callback', 'portfolioMrMas_options', 'portfolioMrMas-sidebar-options');
    add_settings_field('sidebar-linkedin', 'LinkedIn', 'portfolioMrMas_sidebar_linkedin_callback', 'portfolioMrMas_options', 'portfolioMrMas-sidebar-options');
    add_settings_field('sidebar-github', 'GitHub', 'portfolioMrMas_sidebar_github_callback', 'portfolioMrMas_options', 'portfolioMrMas-sidebar-options');
    add_settings_field('sidebar-email', 'Email', 'portfolioMrMas_sidebar_email_callback', 'portfolioMrMas_options', 'portfolioMrMas-sidebar-options');

    // Theme Support Options
    register_setting('portfolioMrMas-theme-support', 'post_formats');
    register_setting('portfolioMrMas-theme-support', 'custom_header');
    register_setting('portfolioMrMas-theme-support', 'custom_background');

    add_settings_section('portfolioMrMas-theme-options', 'Theme Options', 'portfolioMrMas_theme_options_section_callback', 'portfolioMrMas_options_theme');

    add_settings_field('post-formats', 'Post Formats', 'portfolioMrMas_post_formats_callback', 'portfolioMrMas_options_theme', 'portfolioMrMas-theme-options');
    add_settings_field('custom-header', 'Custom Header', 'portfolioMrMas_custom_header_callback', 'portfolioMrMas_options_theme', 'portfolioMrMas-theme-options');
    add_settings_field('custom-backgroung', 'Custom Backgroung', 'portfolioMrMas_custom_background_callback', 'portfolioMrMas_options_theme', 'portfolioMrMas-theme-options');

    // Contact Form Options
    register_setting('portfolioMrMas-contact-options', 'activate_contact');

    add_settings_section('portfolioMrMas-contact-section', 'Contact form', 'portfolioMrMas_contact_section_callback', 'portfolioMrMas_options_contact');

    add_settings_field('activate-form', 'Activate Contact Form', 'portfolioMrMas_contact_form_callback', 'portfolioMrMas_options_contact', 'portfolioMrMas-contact-section');

    // Custom CSS Option
    register_setting('portfolioMrMas-custom-css-options','custom_css','portfolioMrMas_sanitize_custom_css');

    add_settings_section('portfolioMrMas-custom-css-section','Custom CSS','portfolioMrMas_custom_css_section_callback','portfolioMrMas_options_css');

    add_settings_field('portfolioMrMas-custom-css-field','Inset Custom CSS','portfolioMrMas_custom_css_form_callback','portfolioMrMas_options_css','portfolioMrMas-custom-css-section');
}

function portfolioMrMas_custom_css_section_callback()
{
    echo 'Customize portfolioMrMas CSS With Your Style';
}

function portfolioMrMas_contact_section_callback()
{
    echo 'Activate and Deactivate the built-in Contact Form';
}

function portfolioMrMas_theme_options_section_callback()
{
    echo 'Activate and Deactivate specific Theme Support Options';
}

function portfolioMrMas_sidebar_options_section_callback()
{
    echo 'Customize your Sidebar Information';
}

function portfolioMrMas_custom_css_form_callback(){
    $css = get_option('custom_css');
    $css = ( empty($css) ? '/* PortfolioMrMas Theme Custom CSS */' : $css );
    echo '<div id="customCss">'.$css.'</div><textarea id="custom_css" name="custom_css" style="display: none; visibility: hidden;">'.$css.'</textarea>';
}

function portfolioMrMas_contact_form_callback()
{
    $options = get_option('activate_contact');
    $checked = isset($options) && $options == 1 ? 'checked' : '';
    echo '<label><input type="checkbox" id="activate_contact" name="activate_contact" value="1" ' . $checked . ' /></label>';
}

function portfolioMrMas_post_formats_callback()
{
    $saved_formats = get_option('post_formats', array());
    $formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
    $output = '';
    foreach ($formats as $format) {
        $checked = isset($saved_formats[$format]) && $saved_formats[$format] == 1 ? 'checked' : '';
        $output .= '<label><input type="checkbox" id="' . $format . '" name="post_formats[' . $format . ']" value="1" ' . $checked . ' /> ' . $format . '</label><br>';
    }
    echo $output;
}

function portfolioMrMas_custom_header_callback()
{
    $options = get_option('custom_header');
    $checked = isset($options) && $options == 1 ? 'checked' : '';
    echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" ' . $checked . ' />Activate the Custom Header</label>';
}

function portfolioMrMas_custom_background_callback()
{
    $options = get_option('custom_background');
    $checked = isset($options) && $options == 1 ? 'checked' : '';
    echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" ' . $checked . ' />Activate the Custom Background</label>';
}

// Sidebar callback functions
function portfolioMrMas_sidebar_profile_picture_callback()
{
    $picture = esc_attr(get_option('profile_picture'));
    if (empty($picture)) {
        echo '<input class="button button-secondary" type="button" value="Upload Profile Picture" id="upload-button" /><input type="hidden" id="profile-picture" name="profile_picture" value="" />';
    } else {
        echo '<input class="button button-secondary" type="button" value="Replace Profile Picture" id="upload-button" /><input type="hidden" id="profile-picture" name="profile_picture" value="' . $picture . '" /> <input class="button button-secondary button-link-delete" type="button" value="Remove" id="remove-button" />';
    }
}

function portfolioMrMas_sidebar_name_callback()
{
    $firstName = esc_attr(get_option('first_name'));
    $lastName = esc_attr(get_option('last_name'));

    echo '<input type="text" name="first_name" value="' . $firstName . '" placeholder="First Name" /> ';
    echo '<input type="text" name="last_name" value="' . $lastName . '" placeholder="last Name" /> ';
}

function portfolioMrMas_sidebar_user_description_callback()
{
    $user_description = esc_attr(get_option('user_description'));
    echo '<input type="text" name="user_description" value="' . $user_description . '" placeholder="Description" /><p class="description">Input a short description about yourself.</p>';
}

function portfolioMrMas_sidebar_instagram_callback()
{
    $instagram = esc_attr(get_option('instagram'));
    echo '<input type="text" name="instagram" value="' . $instagram . '" placeholder="Instagram" /><p class="description">Input your Instagram username without @ character.</p>';
}

function portfolioMrMas_sidebar_linkedin_callback()
{
    $linkedin = esc_attr(get_option('linkedin'));
    echo '<input type="text" name="linkedin" value="' . $linkedin . '" placeholder="linkedIn" />';
}

function portfolioMrMas_sidebar_telegram_callback()
{
    $telegram = esc_attr(get_option('telegram'));
    echo '<input type="text" name="telegram" value="' . $telegram . '" placeholder="Telegram" /> ';
}

function portfolioMrMas_sidebar_github_callback()
{
    $github = esc_attr(get_option('github'));
    echo '<input type="text" name="github" value="' . $github . '" placeholder="GitHub" /> ';
}

function portfolioMrMas_sidebar_email_callback()
{
    $email = esc_attr(get_option('email'));
    echo '<input type="text" name="email" value="' . $email . '" placeholder="Email" /> ';
}

// Sanitization Setting

function portfolioMrMas_saitize_input($input)
{
    $output = sanitize_text_field($input);
    $output = str_replace('@', '', $output);
    return $output;
}

function portfolioMrMas_saitize_email($input)
{
    $output = sanitize_email($input);
    return $output;
}

function portfolioMrMas_sanitize_custom_css($input) {
    $output = esc_textarea($input);
    return $output;
}

// Templates submenu Functions 

function portfolioMrMas_theme_support_page_callback()
{
    require_once(get_template_directory() . '/inc/templates/portfolioMrMas-theme-support-temp.php');
}

function portfolioMrMas_theme_contact_page_callback()
{
    require_once(get_template_directory() . '/inc/templates/portfolioMrMas-theme-contact.php');
}

function portfolioMrMas_theme_create_page_callback()
{
    require_once(get_template_directory() . '/inc/templates/portfolioMrMas-admin.php');
}

function portfolioMrMas_theme_settings_page_callback() {
    require_once(get_template_directory() . '/inc/templates/portfolioMrMas-custom-css.php');
}
