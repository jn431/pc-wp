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



if (!class_exists('Impression_Theme')) {
   class Impression_Theme
   {

      public $default_max_desktop_width = 1440;
      public $default_med_desktop_width = 1100;
      public $primary_color = '#03bafc';
      public $secondary_color = '#00FF00';

      /**
       * Instantiate the object.
       */
      public function __construct()
      {
         add_action('wp_enqueue_scripts', array($this, 'enqueue_custom_variables'));

         if (is_admin()) {
            new Impression_Admin;
         }

         if (is_login()) {
            new Impression_Login($this->primary_color, $this->secondary_color);
         }
      }

      public function enqueue_custom_variables()
      {
         $default_max_desktop_width = $this->default_max_desktop_width;
         $default_med_desktop_width = $this->default_med_desktop_width;
         $custom_css = ":root {
            --primary-color:      {$this->primary_color};
            --secondary-color:    {$this->secondary_color};
            --content-max-width:  {$default_max_desktop_width}px;
            --content-med-width:  {$default_med_desktop_width}px;
         }";
         wp_add_inline_style('main-style', $custom_css);
      }

   }
}
