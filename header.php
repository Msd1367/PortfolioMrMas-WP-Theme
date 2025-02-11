<?php
// This is the template for header
// @package portfolioMrMas
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <title> <?php bloginfo('name');
            wp_title();  ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if (is_singular() && pings_open(get_queried_object())): ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif ?>
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <div class="faded-background"></div>
    <div class="portfolioMrMas-sidebar">
        <div class="portfolioMrMas-sidebar-container">
            <div class="sidebar-scroll">
                <?php get_sidebar(); ?>
            </div>
        </div>
        <div class="toggle-sidebar">
            <i class="fa fa-chevron-left"></i>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-xs-12">

                <header class="header-container background-image text-center" style="background-image: url(<?php header_image(); ?>);" role="banner" aria-label="Header Image Section">

                    <div class="header-content table">
                        <div class="table-cell">
                            <h1 class="site-title portfolioMrMas-logo">
                                <?php bloginfo('name'); ?>
                            </h1>
                            <h2 class="site-description"><?php bloginfo('description'); ?></h2>
                        </div><!-- .table-cell -->
                    </div><!-- .header-content -->

                    <div class="nav-container">
                        <nav class="navbar navbar-default navbar-portfolioMrMas">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'container' => false,
                                'menu_class' => 'nav navbar-nav',
                                'walker' => new portfolioMrMas_Walker_Nav_Primary()
                            ));
                            ?>
                        </nav>
                    </div><!-- .nav-container -->

                </header><!-- .header-container -->

            </div><!-- .col-xs-12 -->
        </div><!-- .row -->

    </div><!-- .container -->