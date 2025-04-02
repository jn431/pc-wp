<?php

/**
 * Displaying page content in page.php
 * @package WordPress
 * @subpackage Impression
 */

?>

<section class="page__section hero med--width">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (has_post_thumbnail()) : ?>
		<div class="thumbnail-banner">
			<?php the_post_thumbnail( 'full' ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">


		<h1 class="med--header"><?php the_title(); ?></h1>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before'   => '<nav class="page-links" aria-label="' . esc_attr__('Page', 'impression') . '">',
				'after'    => '</nav>',
				/* translators: %: Page number. */
				'pagelink' => esc_html__('Page %', 'impression'),
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if (get_edit_post_link()) : ?>
		<div class="admin-control-modal">
			<?php
			edit_post_link(
				sprintf(
					esc_html__('Edit %s', 'impression'),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				),
				'<button class="edit-post-btn">',
				'</button>'
			);
			?>
		</div>
	<?php endif; ?>
</article>
</section>