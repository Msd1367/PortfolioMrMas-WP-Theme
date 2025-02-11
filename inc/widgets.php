<?php
/* @package portfolioMrMas */

// Creating the widget 
class portfolioMrMas_profile_info_widget extends WP_Widget
{

    //setup the widget name, description, etc...
    function __construct()
    {
        parent::__construct(
            'portfolioMrMas_profile_info_widget',
            __('Profile Info Widget', 'portfolioMrMas'),
            array(
                'description' => __('A widget to display Profile information', 'portfolioMrMas'),
                'classname'   => 'portfolioMrMas_profile_info'
            )
        );
    }

    // Widget Backend 
    public function form($instance)
    {
        echo '<p><strong>No options for this Widget!</strong><br/>You can control the fields of this Widget from <a href="./admin.php?page=portfolioMrMas_options">This Page</a></p>';
    }

    // Creating widget front-end
    public function widget($args, $instance)
    {
        $fullName = esc_attr(get_option('first_name')) . ' ' . esc_attr(get_option('last_name'));
        $description = esc_attr(get_option('user_description'));
        $email = esc_attr(get_option('email'));
        $profile_pic = esc_attr(get_option('profile_picture'));


        $instagram = esc_attr(get_option('instagram'));
        $telegram = esc_attr(get_option('telegram'));
        $linkedIn = esc_attr(get_option('linkedIn'));
        $gitHub = esc_attr(get_option('gitHub'));

        echo $args['before_widget'];
?>
            <div class="image-container">
                <div class="profile-picture">
                    <img id="profile-picture-preview" src="<?= $profile_pic ?>" alt="<?= $fullName ?> profile picture" />

                </div>
            </div>
            <h1 class="portfolioMrMas-username"><?= $fullName ?></h1>
            <h2 class="portfolioMrMas-description"><?= $description ?></h2>
            <div class="portfolioMrMas-social-media-icons">
                <?php if (!empty($instagram)): ?>
                    <a href="<?php echo $instagram ?>" target="_blank" aria-label="Instagram">
                        <span class="fab fa-instagram"></span>
                    </a>
                <?php endif;
                if (!empty($telegram)): ?>
                    <a href="<?php echo $telegram ?>" target="_blank" aria-label="Telegram">
                        <span class="fab fa-telegram"></span>
                    </a>
                <?php endif;
                if (!empty($linkedIn)): ?>
                    <a href="<?php echo $linkedIn ?>" target="_blank" aria-label="LinkedIn">
                        <span class="fab fa-linkedin"></span>
                    </a>
                <?php endif;
                if (!empty($gitHub)): ?>
                    <a href="<?php echo $gitHub ?>" target="_blank" aria-label="GitHub">
                        <span class="fab fa-github"></span>
                    </a>
                <?php endif; ?>

            </div>
            <?php if (!empty($email)): ?>
                <h3 class="portfolioMrMas-email"><a href="mailto: <?= $email ?>" aria-label="Email"><?= $email ?></a></h3>
            <?php endif; ?>
<?php

        echo $args['after_widget'];
    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

// Register and load the widget
function portfolioMrMas_load_widget()
{
    register_widget('portfolioMrMas_profile_info_widget');
}
add_action('widgets_init', 'portfolioMrMas_load_widget');


/*
    Save Posts views
*/
function portfolioMrMas_save_post_views($postID)
{
    $metaKey = 'portfolioMrMas_post_views';
    $views = get_post_meta($postID, $metaKey, true);

    $count = (empty($views) ? 0 : $views);
    $count++;

    update_post_meta($postID, $metaKey, $count);
}
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/*
    Popular Posts Widget
*/

class portfolioMrMas_Popular_Posts_Widget extends WP_Widget
{

    //setup the widget name, description, etc...
    public function __construct()
    {

        $widget_ops = array(
            'classname' => 'portfolioMrMas-popular-posts-widget',
            'description' => 'Popular Posts Widget',
        );
        parent::__construct('portfolioMrMas_popular_posts', 'PortfolioMrMas Popular Posts', $widget_ops);
    }

    // back-end display of widget
    public function form($instance)
    {

        $title = (!empty($instance['title']) ? $instance['title'] : 'Popular Posts');
        $tot = (!empty($instance['tot']) ? absint($instance['tot']) : 4);

        $output = '<p>';
        $output .= '<label for="' . esc_attr($this->get_field_id('title')) . '">Title:</label>';
        $output .= '<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($title) . '"';
        $output .= '</p>';

        $output .= '<p>';
        $output .= '<label for="' . esc_attr($this->get_field_id('tot')) . '">Number of Posts:</label>';
        $output .= '<input type="number" class="widefat" id="' . esc_attr($this->get_field_id('tot')) . '" name="' . esc_attr($this->get_field_name('tot')) . '" value="' . esc_attr($tot) . '"';
        $output .= '</p>';

        echo $output;
    }

    //update widget
    public function update($new_instance, $old_instance)
    {

        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ? strip_tags($new_instance['title']) : '');
        $instance['tot'] = (!empty($new_instance['tot']) ? absint(strip_tags($new_instance['tot'])) : 0);

        return $instance;
    }

    //front-end display of widget
    public function widget($args, $instance)
    {

        $tot = absint($instance['tot']);

        $posts_args = array(
            'post_type' => 'post',
            'posts_per_page' => $tot,
            'meta_key' => 'portfolioMrMas_post_views',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        );

        $posts_query = new WP_Query($posts_args);

        echo $args['before_widget'];

        if (!empty($instance['title'])) :

            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];

        endif;

        if ($posts_query->have_posts()) :

            echo '<ul>';

            while ($posts_query->have_posts()) : $posts_query->the_post();

                echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';

            endwhile;

            echo '</ul>';

        endif;

        echo $args['after_widget'];
    }
}

add_action('widgets_init', function () {
    register_widget('portfolioMrMas_Popular_Posts_Widget');
});

