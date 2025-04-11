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

if (!class_exists('Impression_Login')) {
    class Impression_Login
    {
        public $primary_color;
        public $secondary_color;

        public function __construct($primary_color, $secondary_color)
        {
            $this->primary_color = $primary_color;
            $this->secondary_color = $secondary_color;
            add_action('login_enqueue_scripts', array($this, 'impression_login_enqueue'));
            // add_filter('login_headertext', array($this, 'impression_url_title'));
            add_action('login_head', array($this, 'impression_login_logo'));
        }

        public function impression_login_logo()
        {
            $custom_logo_id = get_theme_mod('custom_logo') ?: null;
            $custom_logo_url = "";

            if ($custom_logo_id) {
                $custom_logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
            } else {

                if (file_exists(IMPRESSION_THEME_DIR . 'assets/images/logo.png')) {
                    $custom_logo_url = IMPRESSION_THEME_URI . 'assets/images/logo.png';
                }
            }
            $aspect_ratio = $this->get_image_aspect_ratio(IMPRESSION_THEME_DIR . 'assets/images/logo.png');
?>
            <style>
                body.login div#login h1 a {
                    background: url("<?= $custom_logo_url; ?>") center center / contain no-repeat;
                    height: 100px;
                    width: 200px;
                    margin: 0 auto 12px;
                }
            </style>
<?php
        }

        public function impression_login_enqueue()
        {
            wp_enqueue_style('login-style', IMPRESSION_THEME_URI . 'assets/css/login.css', array(), '1.0');



            $custom_css = ":root {
                --primary-color: $this->primary_color;
                --secondary-color: $this->secondary_color;
            }";
            wp_add_inline_style('login-style', $custom_css);
        }

        public function get_image_aspect_ratio($image_path)
        {
            // Check if the file exists
            if (!file_exists($image_path)) {
                return false;
            }

            $info = getimagesize($image_path);
            list($width, $height) = getimagesize($image_path);

            // Calculate aspect ratio
            if ($height > 0) {
                $aspect_ratio = $width / $height;
                return $aspect_ratio;
            } else {
                return false; // To avoid division by zero
            }
        }

        public function impression_url_title()
        {
            return 'foo';
        }
    }
}
