<?php

/**
 * Customizer settings for this theme.
 * @package WordPress
 * @subpackage Impression
 * @since 1.0.0
 * @see WP_Customize_Control
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('Impression_Customize')) {
    class Impression_Customize
    {
        public function __construct()
        {
            add_action('customize_register', array($this, 'impression_register'));
        }

        /**
         * Register customizer options.
         * @param WP_Customize_Manager $wp_customize Theme Customizer object.
         * @return void
         */

        public function impression_register($wp_customize)
        {
            // Add a new section for foreground color setting
            $wp_customize->add_section('impression_theme_colors', array(
                'title' => __('Foreground Color', 'impression'),
                'priority' => 30,
            ));

            // Add the foreground color setting
            $wp_customize->add_setting('theme_foreground_color', array(
                'type' => 'theme_mod', // or 'option'
                'capability' => 'edit_theme_options',
                'default' => '#000000', // Set a default foreground color (black in this case)
                'sanitize_callback' => 'sanitize_hex_color', // Ensure a valid hex color value
                'transport' => 'postMessage', // Live preview using JavaScript
            ));

            // Add the foreground color control (color picker)
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'theme_foreground_color', array(
                'label' => __('Foreground Color', 'impression'),
                'section' => 'theme_foreground_color_section',
                'settings' => 'theme_foreground_color',
            )));
        }


        /**
         * Sanitize boolean for checkbox.
         * @param  bool $checked Whether or not a box is checked.
         * @return bool
         */
        public static function sanitize_checkbox($checked = null)
        {
            return (bool) isset($checked) && true === $checked;
        }

        /**
         * Sanitize boolean for checkbox.
         * @param  string
         * @return string
         */
        public static function sanitize_phone_no($input)
        {
            $regex = "/^(\(?\d{3}\)?)?[- .]?(\d{3})[- .]?(\d{4})$/";
            $input = preg_replace($regex, "(\\1) \\2-\\3", $input);

            if (strlen($input) < 10 || strlen($input) > 14 || preg_match("/[a-z]/i", $input)) {
                return new \WP_Error('invalid', __('Invalid phone number (format: +1(123)555-1234'));
            } else {
                return $input;
            }
        }

        /**
         * Validate URL
         * @param bool $validity
         * @param string $value
         * @return false
         */
        public static function validate_url_input($validity, $value)
        {
            if ($value === "") {
                return true;
            } else if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
                return new \WP_Error('invalid', __('Enter a valid url'));
            }
            return true;
        }

    }
}
