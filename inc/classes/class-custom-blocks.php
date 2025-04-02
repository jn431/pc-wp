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

if (!class_exists('Impression_Custom_Blocks')) {
    class Impression_Custom_Blocks
    {
        /**
         * Instantiate the object.
         */
        public function __construct()
        {
            // Enqueue block scripts and styles
            add_action('enqueue_block_editor_assets', array($this, 'enqueue_scripts_styles'));

            // Register the blocks
            add_action('init', array($this, 'register_custom_blocks'));

            add_filter('block_categories_all', array($this, 'register_custom_blocks_category'), 10, 2);
        }

        // Enqueue block scripts and styles
        public function enqueue_scripts_styles()
        {
            wp_enqueue_script(
                'jaeins-custom-blocks-script',
                IMPRESSION_THEME_URI . 'assets/js/js-blocks.js',
                array('wp-blocks', 'wp-element'),
                '1.0',
                true
            );

            wp_enqueue_style(
                'jaeins-custom-blocks-style',
                IMPRESSION_THEME_URI . 'assets/css/css-blocks.css',
            );
        }

        function register_custom_blocks_category($categories, $post) {
            $categories_sorted = array();

            $impression_block = array(
                'slug' => 'impression',
                'title' => 'Jaeins Custom Blocks',
            );

            $categories_sorted = array();
            $categories_sorted[0] = $impression_block;

            foreach ($categories as $category) {
                $categories_sorted[] = $category;
            }

            return $categories_sorted;
        }


        // Register the blocks
        public function register_custom_blocks()
        {
            register_block_type('jaeins-custom-blocks/abc-block', array(
                'editor_script' => 'jaeins-custom-blocks-script',
                'editor_style' => 'jaeins-custom-blocks-style',
                'render_callback' => array($this, 'render_hero_section'),
                'category'  => 'impression',
                'attributes' => array(
                    'image' => array(
                        'type' => 'string',
                        'default' => ''
                    ),
                    'title' => array(
                        'type' => 'string',
                        'default' => 'Title'
                    ),
                    'subtitle' => array(
                        'type' => 'string',
                        'default' => 'Subtitle'
                    )
                )
            ));
        }


        // Block rendering callback for the ABC block
        public function render_hero_section($attributes)
        {
            $image = $attributes['image'];
            $title = $attributes['title'];
            $subtitle = $attributes['subtitle'];

            ob_start();
?>
            <div class="jaeins-design-block">
                <?php print_r($image); ?>
                <?php if ($image) : ?>
                    <img src="<?php echo esc_url($image); ?>" alt="Image">
                <?php endif; ?>
                <h2 class="title"><?php echo esc_html($title); ?></h2>
                <p class="subtitle"><?php echo esc_html($subtitle); ?></p>
            </div>
<?php
            return ob_get_clean();
        }
    }
}
