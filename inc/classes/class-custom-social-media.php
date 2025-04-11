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

if (!class_exists('Impression_Customizer_Social_Media')) {
    class Impression_Customizer_Social_Media extends Impression_Customize
    {
        public function __construct()
        {
            add_action('customize_register', array($this, 'register_customizer_options'));
            add_action('impression_social_media', array($this, 'render_social_media'));
        }

        function register_customizer_options($wp_customize)
        {
            // Add a section for social_media
            $wp_customize->add_section('social_media_section', array(
                'title' => __('Social Media', 'custom-theme'),
                'priority' => 30,
            ));

            /* Discord */
            $wp_customize->add_setting('social_media_discord', array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('social_media_discord', array(
                'label' => __('Discord', 'custom-theme'),
                'section' => 'social_media_section',
                'type' => 'text',
            ));

            /* Facebook */
            $wp_customize->add_setting('social_media_facebook', array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('social_media_facebook', array(
                'label' => __('Facebook', 'custom-theme'),
                'section' => 'social_media_section',
                'type' => 'text',
            ));


            /* Instagram */
            $wp_customize->add_setting('social_media_instagram', array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('social_media_instagram', array(
                'label' => __('Instagram', 'custom-theme'),
                'section' => 'social_media_section',
                'type' => 'text',
            ));

            /* LinkedIn */
            $wp_customize->add_setting('social_media_linkedin', array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('social_media_linkedin', array(
                'label' => __('LinkedIn', 'custom-theme'),
                'section' => 'social_media_section',
                'type' => 'text',
            ));

            /* Reddit */
            $wp_customize->add_setting('social_media_reddit', array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('social_media_reddit', array(
                'label' => __('Reddit', 'custom-theme'),
                'section' => 'social_media_section',
                'type' => 'text',
            ));


            /* TikTok */
            $wp_customize->add_setting('social_media_tiktok', array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('social_media_tiktok', array(
                'label' => __('TikTok', 'custom-theme'),
                'section' => 'social_media_section',
                'type' => 'text',
            ));

            /* Twitch */
            $wp_customize->add_setting('social_media_twitch', array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('social_media_twitch', array(
                'label' => __('Twitch', 'custom-theme'),
                'section' => 'social_media_section',
                'type' => 'text',
            ));


            /* Twitter/X */
            $wp_customize->add_setting('social_media_twitter', array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('social_media_twitter', array(
                'label' => __('Twitter/X', 'custom-theme'),
                'section' => 'social_media_section',
                'type' => 'text',
            ));

            /* YouTube */
            $wp_customize->add_setting('social_media_youtube', array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('social_media_youtube', array(
                'label' => __('YouTube', 'custom-theme'),
                'section' => 'social_media_section',
                'type' => 'text',
            ));
        }

        public function render_social_media()
        {
            $socials = ['discord', 'facebook', 'instagram', 'linkedin', 'reddit', 'tiktok', 'twitch', 'twitter', 'youtube'];
            $social_links = [];

            foreach ($socials as $key) {
                $link = get_theme_mod("social_media_$key");
                if ($link) {
                    $social_links[$key] = $link;
                }
            }

            // Make variable available in the template
            ob_start();
            include locate_template('template-parts/partials/social-media.php');
            $social_media_content = ob_get_clean();
            echo $social_media_content;

            /* echo "<ul>";
            foreach ($socials as $key) {
                $social_links[$key] = get_theme_mod("social_media_$key");
                if ($social_links[$key]) {
                    echo "<li class='sm'><a href='$social_links[$key]'>$key</a></li>";
                }
            }
            echo "</ul>"; */

            //get_theme_mod('enable_social_media', false);

            /*  $enable_social_media = get_theme_mod('enable_social_media', false);
            if ($enable_social_media) {
                ob_start();
                include(get_template_directory() . '/template-parts/header/social_media.php');
                $social_media_content = ob_get_clean();

                echo $social_media_content;
            } */
        }
    }
}
