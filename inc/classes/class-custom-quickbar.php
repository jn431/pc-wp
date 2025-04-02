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

if (!class_exists('Impression_Customizer_Quickbar')) {
    class Impression_Customizer_Quickbar extends Impression_Customize
    {
        public function __construct()
        {
            add_action('customize_register', array($this, 'register_customizer_options'));
            add_action('impression_quickbar', array($this, 'render_quickbar'));
        }

        function register_customizer_options($wp_customize)
        {
            // Add a section for Quickbar
            $wp_customize->add_section('quickbar_section', array(
                'title' => __('Quickbar', 'custom-theme'),
                'priority' => 30,
            ));

            // Add a checkbox for enabling quickbar
            $wp_customize->add_setting('enable_quickbar', array(
                'default' => false,
                'sanitize_callback' => $this->sanitize_checkbox()
            ));

            $wp_customize->add_control('enable_quickbar', array(
                'label' => __('Enable Quickbar', 'custom-theme'),
                'section' => 'quickbar_section',
                'type' => 'checkbox',
            ));

            // Add input fields for phone number, email, Instagram, and Twitter
            $wp_customize->add_setting('quickbar_phone', array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('quickbar_phone', array(
                'label' => __('Phone Number', 'custom-theme'),
                'section' => 'quickbar_section',
                'type' => 'text',
            ));

            $wp_customize->add_setting('quickbar_email', array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('quickbar_email', array(
                'label' => __('Email', 'custom-theme'),
                'section' => 'quickbar_section',
                'type' => 'email',
            ));

            $wp_customize->add_setting('quickbar_instagram', array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('quickbar_instagram', array(
                'label' => __('Instagram', 'custom-theme'),
                'section' => 'quickbar_section',
                'type' => 'text',
            ));

            $wp_customize->add_setting('quickbar_twitter', array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('quickbar_twitter', array(
                'label' => __('Twitter', 'custom-theme'),
                'section' => 'quickbar_section',
                'type' => 'text',
            ));
        }

        public function render_quickbar()
        {
            $enable_quickbar = get_theme_mod('enable_quickbar', false);
            if ($enable_quickbar) {
                ob_start();
                include(get_template_directory() . '/template-parts/header/quickbar.php');
                $quickbar_content = ob_get_clean();

                echo $quickbar_content;
            }
        }
    }
}
