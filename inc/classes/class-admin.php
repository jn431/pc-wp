<?php

/**
 * Customizer Class for Colors
 * @package WordPress
 * @subpackage Impression
 * @since 1.0.0
 * @see WP_Customize_Control
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('Impression_Admin')) {
    class Impression_Admin
    {
        public function __construct()
        {

            add_action('wp_enqueue_scripts', array($this, 'impression_admin_frontend_enqueue'));

            // Load only on admin side.
            if (!is_admin()) {
                return;
            }

            add_action('admin_enqueue_scripts', array($this, 'impression_admin_backend_enqueue'));

            add_action('wp_dashboard_setup', array($this, 'impression_set_metaboxes'));
        }

        public function impression_admin_frontend_enqueue()
        {
            wp_enqueue_style('admin-frontend-style', IMPRESSION_THEME_URI . 'assets/css/admin-frontend.css', array(), '1.0');
        }

        public function impression_admin_backend_enqueue()
        {
            wp_enqueue_style('admin-backend-style', IMPRESSION_THEME_URI . 'assets/css/admin-backend.css', array(), '1.0');
        }

        function impression_set_metaboxes() {

            remove_meta_box('dashboard_primary', 'dashboard', 'side');      // WordPress blog
            remove_meta_box('dashboard_secondary', 'dashboard', 'side');    // Other WordPress News
            remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  // Quick Draft
        }
    }
}
