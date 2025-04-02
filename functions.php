<?php

/**
 * Custom Colors Class
 * @package WordPress
 * @subpackage Impression
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'IMPRESSION_THEME_VERS', '4.1.6' );
define( 'IMPRESSION_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'IMPRESSION_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );
// define( 'IMPRESSION_THEME_PRO_UPGRADE_URL', 'https://rebelgroupdigital.com/impression-upgrade-now' );

/**
 * Require Helper Files
 */
require IMPRESSION_THEME_DIR . 'inc/classes/class-impression.php';
require IMPRESSION_THEME_DIR . 'inc/classes/class-admin.php';
require IMPRESSION_THEME_DIR . 'inc/classes/class-login.php';
require IMPRESSION_THEME_DIR . 'inc/classes/class-customize.php';
require IMPRESSION_THEME_DIR . 'inc/classes/class-custom-fonts.php';
require IMPRESSION_THEME_DIR . 'inc/classes/class-custom-quickbar.php';
require IMPRESSION_THEME_DIR . 'inc/classes/class-custom-blocks.php';

function impression_theme_assets()
{
    // Enqueue main stylesheet

    // wp_enqueue_style('normalize', get_template_directory_uri() . '/assets/css/normalize.css', array(), '1.0');
    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0');
    wp_enqueue_style('style', get_stylesheet_uri(), array(), '1.0');

    wp_enqueue_script(
		'main-js',
		get_theme_file_uri( '/assets/js/js-impression.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}

add_action('wp_enqueue_scripts', 'impression_theme_assets');

if (!function_exists('impression_theme_setup')) {
    function impression_theme_setup()
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1568, 9999);

        add_theme_support(
            'html5',
            array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
                'navigation-widgets',
            )
        );

        register_nav_menus(
            array(
                'primary' => esc_html__('Primary menu', 'impression'),
                'footer'  => esc_html__('Secondary menu', 'impression'),
            )
        );

        /*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
        $logo_width  = 300;
        $logo_height = 100;

        add_theme_support(
            'custom-logo',
            array(
                'height'               => $logo_height,
                'width'                => $logo_width,
                'flex-width'           => true,
                'flex-height'          => true,
                'unlink-homepage-logo' => true,
            )
        );

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');


        // Editor color palette.
        $black     = '#000000';
        $dark_gray = '#252525';
        $gray      = '#504F4F';
        $green     = '#3D9C46';
        $blue      = '#2596BE';
        $purple    = '#75097D';
        $red       = '#C72022';
        $orange    = '#D0490B';
        $yellow    = '#EAC21C';
        $white     = '#FFFFFF';

        add_theme_support(
            'editor-color-palette',
            array(
                array(
                    'name'  => esc_html__('Black', 'impression'),
                    'slug'  => 'black',
                    'color' => $black,
                ),
                array(
                    'name'  => esc_html__('Dark gray', 'impression'),
                    'slug'  => 'dark-gray',
                    'color' => $dark_gray,
                ),
                array(
                    'name'  => esc_html__('Gray', 'impression'),
                    'slug'  => 'gray',
                    'color' => $gray,
                ),
                array(
                    'name'  => esc_html__('Green', 'impression'),
                    'slug'  => 'green',
                    'color' => $green,
                ),
                array(
                    'name'  => esc_html__('Blue', 'impression'),
                    'slug'  => 'blue',
                    'color' => $blue,
                ),
                array(
                    'name'  => esc_html__('Purple', 'impression'),
                    'slug'  => 'purple',
                    'color' => $purple,
                ),
                array(
                    'name'  => esc_html__('Red', 'impression'),
                    'slug'  => 'red',
                    'color' => $red,
                ),
                array(
                    'name'  => esc_html__('Orange', 'impression'),
                    'slug'  => 'orange',
                    'color' => $orange,
                ),
                array(
                    'name'  => esc_html__('Yellow', 'impression'),
                    'slug'  => 'yellow',
                    'color' => $yellow,
                ),
                array(
                    'name'  => esc_html__('White', 'impression'),
                    'slug'  => 'white',
                    'color' => $white,
                ),
            )
        );

        add_theme_support('editor-styles');

        add_editor_style( get_template_directory_uri() . '/assets/css/editor-styles.css' );
    }

    add_action('after_setup_theme', 'impression_theme_setup');

    /**
     * Disable screen options on the dashboard
     */
    function disable_at_a_glance_widget() {
        global $wp_meta_boxes;

        if (isset($wp_meta_boxes['dashboard'])) {
            if (isset($wp_meta_boxes['dashboard']['normal'])) {
                if (isset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'])) {
                    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
                }
            }
        }
    }
    add_action('wp_dashboard_setup', 'disable_at_a_glance_widget');

    /**
     * Placeholder navigation fallback
     */
    function navigation_menu_fallback() {
        echo '<nav class="primary-menu">';
        echo '<ul class="menu">';
        echo '<li class="menu-item"><a href="#">Primary navigation has not been chosen</a></li>';
        echo '</ul>';
        echo '</nav>';
    }

    /**
     * Display customizer set logo or display Logo Ipsum
     */
    function render_customizer_logo() {
        $custom_logo_id = get_theme_mod('custom_logo');
        $custom_logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');

        if ($custom_logo_url) {
            echo '<img src="' . esc_url($custom_logo_url) . '" alt="' . get_bloginfo('name') . '">';
        } else {
            echo '<img src="' . IMPRESSION_THEME_URI . 'assets/images/placeholder-logo.svg" alt="' . get_bloginfo('name') . '">';
        }
    }
}


new Impression_Theme();
new Impression_Customize();
new Impression_Custom_Fonts();
new Impression_Customizer_Quickbar();
$block = new Impression_Custom_Blocks();