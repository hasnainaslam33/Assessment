<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="main-header">
        <div class="container">
            <div class="custom-header">
                <div class="custom-logo">
                    <a href="<?php echo get_home_url(); ?>">
                        <h1 class="custom-title"><?php bloginfo('name'); ?></h1>
                    </a>
                </div>
                <div class="custom-menu">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'primary-menu',
                        'container' => 'nav',
                    ));
                    ?>
                </div>
                <div class="mobile-menu-toggle">
                    <span class="menu-icon">☰</span>
                </div>
                <nav id="mobile-navigation" class="mobile-menu">
                    <div class="close-navigation">
                        <span>x</span>
                    </div>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'mobile-menu-items',
                    ));
                    ?>
                </nav>
            </div>
        </div>
    </header>