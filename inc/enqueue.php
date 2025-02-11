<?PHP

/* @package portfolioMrMas */

/* ============== ADMIN ENQUEUE FUNCTIONS ============== */

function portfolioMrMas_load_admin_scripts($hook)
{
    if ($hook == 'toplevel_page_portfolioMrMas_options') {
        wp_register_style('portfolioMrMas-admin', get_template_directory_uri() . '/css/portfolioMrMas_admin.css', array(), '1.0.0', 'all');
        wp_enqueue_style('portfolioMrMas-admin');

        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fonts/fontawesome/css/all.min.css', array(), '6.6.0');

        wp_enqueue_media();

        wp_register_script('portfolioMrMas-admin-js', get_template_directory_uri() . '/js/portfolioMrMas-admin.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('portfolioMrMas-admin-js');

    } else if ($hook == 'portfoliomrmas_page_portfolioMrMas_options_css') {
        wp_enqueue_style('portfolioMrMas-custom-css-style', get_template_directory_uri() . '/css/portfolioMrMas_custom_css.css', array(), '1.0.0', 'all');

        wp_enqueue_script('ace', get_template_directory_uri() . '/js/ace/ace.js', array('jquery'), '1.36.5', true);
        wp_enqueue_script('portfolioMrMas-custom-css-script', get_template_directory_uri() . '/js/portfolioMrMas-custom-css.js', array('jquery'), '1.0.0', true);

    } else {
        return;
    }
}
add_action('admin_enqueue_scripts', 'portfolioMrMas_load_admin_scripts');

/* ============== FRONT-END ENQUEUE FUNCTIONS ============== */

function portfolioMrMas_load_frontEnd_scripts() {
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '5.3.3', 'all');
    wp_enqueue_style('portfolioMrMas', get_template_directory_uri() . '/css/portfolioMrMas.css', array(), '1.0.0', 'all');
    wp_enqueue_style('Roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fonts/fontawesome/css/all.min.css', array(), '6.6.0', 'all');

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '5.3.3', true);

    wp_enqueue_script('portfolioMrMas', get_template_directory_uri() . '/js/portfolioMrMas.js', array('jquery'), '1.0.0', true);

    wp_enqueue_script('portfolioMrMas-ajax', get_template_directory_uri() . '/js/load-more.js', array('jquery'), null, true);
    wp_localize_script('portfolioMrMas-ajax', 'portfolioMrMas_ajax', ['ajax_url' => admin_url('admin-ajax.php')]);
}
add_action('wp_enqueue_scripts', 'portfolioMrMas_load_frontEnd_scripts');
























