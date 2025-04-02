<?php

/**
 * Customize Color Control class.
 * @package WordPress
 * @subpackage Impression
 * @since 1.0.0
 * @see WP_Customize_Control
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!class_exists('Impression_Customize_Color_Control')) {
	class Impression_Customize_Color_Control extends WP_Customize_Color_Control
	{
		/**
		 * Enqueue control related scripts/styles.
		 * @return void
		 */
		public function enqueue()
		{
			parent::enqueue();

			// Enqueue the script.
			wp_enqueue_script(
				'impression-control-color',
				get_theme_file_uri('assets/js/palette-colorpicker.js'),
				array('customize-controls', 'jquery', 'customize-base', 'wp-color-picker'),
				wp_get_theme()->get('Version'),
				false
			);
		}
	}
}
