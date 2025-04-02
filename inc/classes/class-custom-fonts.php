<?php

/**
 * Customizer Class for Fonts
 * @package WordPress
 * @subpackage Impression
 * @since 1.0.0
 * @see WP_Customize_Control
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('Impression_Custom_Fonts')) {
    class Impression_Custom_Fonts
    {
        public static $google_fonts = array();
        public static $google_fonts_variants = array();

        public function __construct()
        {
            add_action('customize_register', array($this, 'register_customizer_options'));
            add_action('wp_enqueue_scripts', array($this, 'enqueue_custom_fonts'));
        }

        // Function to register customizer options
        public function register_customizer_options($wp_customize)
        {
            // Add a new section for custom fonts
            $wp_customize->add_section('theme_fonts_section', array(
                'title' => __('Fonts', 'impression'),
                'priority' => 30,
            ));

            // Add a setting to store the selected custom font
            $wp_customize->add_setting('impression_header_font', array(
                'default' => 'Roboto', // Default font
                'sanitize_callback' => 'sanitize_text_field',
            ));

            // Add a control to choose the custom font
            $wp_customize->add_control('impression_header_font', array(
                'type' => 'select',
                'label' => __('Header Font', 'impression'),
                'section' => 'theme_fonts_section',
                'choices' => $this->get_custom_font_names(), // Function to get custom fonts list
            ));

            $wp_customize->add_setting('impression_body_font', array(
                'default' => 'Roboto', // Default body font
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('impression_body_font', array(
                'type' => 'select',
                'label' => __('Body Font', 'impression'),
                'section' => 'theme_fonts_section',
                'choices' => $this->get_custom_font_names()
            ));
        }

        /**
         * Header Fonts
         */
        private function get_custom_header_fonts_list()
        {
            // Add your custom fonts here, in the format "Font Name" => "Font Family"
            $header_fonts = array(
                'Arvo' => 'Arvo',
                'Cormorant Garamond' => 'Cormorant Garamond',
                'Libre Baskerville' => 'Libre Baskerville',
                'Outfit' => 'Outfit',
                'Playfair Display' => 'Playfair Display',
                'Quattrocento' => 'Quattrocento',
            );
            return $header_fonts;
        }

        /**
         * Get font names
         * @return array
         */
        private function get_custom_font_names()
        {
            $google_fonts = apply_filters('impression_fonts_php_file', IMPRESSION_THEME_DIR . 'inc/google-fonts.php');

            if (!file_exists($google_fonts)) {
                return array();
            }

            $google_fonts_arr = include $google_fonts;

            foreach ($google_fonts_arr as $font_name => $font_data) {
                self::$google_fonts[$font_name] = $font_name;
            }
            return apply_filters('impression_google_fonts', self::$google_fonts);
        }

        /**
         * Get selected font's variants
         * @return array
         */
        private function google_font_url_generator($font_one, $font_two = "")
        {
            if (empty(self::$google_fonts_variants)) {

                $google_fonts_file = apply_filters('impression_google_fonts', IMPRESSION_THEME_DIR . 'inc/google-fonts.php');

                if (!file_exists($google_fonts_file)) {
                    return array();
                }
                $google_fonts_arr = include $google_fonts_file;
                $google_fonts_api = "https://fonts.googleapis.com/css?family=";
                $font_one_url = "";
                $font_two_url = "";

                if (!$google_fonts_arr[$font_one]['variants'] || !is_array($google_fonts_arr[$font_one]['variants'])) {
                    return;
                }

                $font_one_url = urlencode($font_one) . ":" . implode(",", $google_fonts_arr[$font_one]['variants']);

                if ($font_two) {
                    if ($google_fonts_arr[$font_two]['variants'] || is_array($google_fonts_arr[$font_two]['variants'])) {
                        $font_two_url = "|" . urlencode($font_two) . ":" . implode(",", $google_fonts_arr[$font_two]['variants']);
                    }
                }
            }

            return $google_fonts_api . $font_one_url . $font_two_url;
        }


        // Function to enqueue the selected custom font
        public function enqueue_custom_fonts()
        {
            $selected_header_font = get_theme_mod('impression_header_font', 'Outfit');
            $selected_body_font = get_theme_mod('impression_body_font', 'Outfit');

            wp_enqueue_style('custom-fonts', $this->google_font_url_generator($selected_header_font, $selected_body_font));

            $custom_css = ":root {
                --header-font: $selected_header_font, sans-serif;
                --body-font: $selected_body_font, sans-serif;
            }";

            wp_add_inline_style('main-style', $custom_css);
        }
    }
}
