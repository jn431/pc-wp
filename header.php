<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class('no-js'); ?>>
    <header>
        <?php do_action('impression_quickbar'); ?>
        <div id="header-wrap">
            <div id="logo-col" class="header-col">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php //render_customizer_logo(); ?>
                    <img src="<?php echo IMPRESSION_THEME_URI . "assets/images/placeholder-logo.svg" ?>" alt="SITE">
                </a>
            </div>
            <div id="menu-col" class="header-col">
                <nav class="main-nav">
                    <?php
                    // Assuming your navigation menu is registered with the name 'primary-menu'.
                    wp_nav_menu(array(
                        'theme_location' => 'primary', // The name of the registered menu location
                        'container'      => '', // Wrap the menu in a <nav> element
                        'container_class' => '', // CSS class for the <nav> container
                        'menu_class'     => 'menu primary-menu', // CSS class for the <ul> element
                        'fallback' => 'navigation_menu_fallback'
                    ));
                    ?>
                </nav>
            </div>
            <div class="header-col">
                <button class="burg-menu" onclick="toggleMenu()">
                    <div class="line top"></div>
                    <div class="line middle"></div>
                    <div class="line bottom"></div>
                </button>
            </div>
        </div>
    </header>