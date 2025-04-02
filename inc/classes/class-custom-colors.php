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

if (!class_exists('Impression_Color_Ctrl')) {
	class Impression_Color_Ctrl
	{

		/**
		 * Instantiate the object.
		 */
		public function __construct()
		{
		}

		/**
		 * Determine the luminance of the given color and then return #fff or #000 so that the text is always readable.
		 * @param string $background_color The background color.
		 * @return string (hex color)
		 */
		public function custom_get_readable_color($background_color)
		{
			return (127 < self::get_relative_luminance_from_hex($background_color)) ? '#000' : '#fff';
		}


		/**
		 * Get luminance from a HEX color.
		 *
		 * @static
		 * @param string $hex The HEX color.
		 * @return int Returns a number (0-255).
		 */
		public static function get_relative_luminance_from_hex($hex)
		{

			// Remove the "#" symbol from the beginning of the color.
			$hex = ltrim($hex, '#');

			// Make sure there are 6 digits for the below calculations.
			if (3 === strlen($hex)) {
				$hex = substr($hex, 0, 1) . substr($hex, 0, 1) . substr($hex, 1, 1) . substr($hex, 1, 1) . substr($hex, 2, 1) . substr($hex, 2, 1);
			}

			// Get red, green, blue.
			$red   = hexdec(substr($hex, 0, 2));
			$green = hexdec(substr($hex, 2, 2));
			$blue  = hexdec(substr($hex, 4, 2));

			// Calculate the luminance.
			$lum = (0.2126 * $red) + (0.7152 * $green) + (0.0722 * $blue);
			return (int) round($lum);
		}
	}
}
