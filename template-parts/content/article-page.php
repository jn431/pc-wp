<?php

/**
 * Displaying page content in single.php
 * @package WordPress
 * @subpackage Impression
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <?php
   $categories = get_the_category();
   if (!empty($categories)) : ?>
      <div class="post-meta">
         <?php $categories = get_the_category();
         if (!empty($categories)) : ?>
            <span class="post-category">
               <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                  <?php echo esc_html($categories[0]->name); ?>
               </a>
            </span>
            <span class="slant-divider">/</span>
         <?php endif; ?>
         <span class="post-date"><?php echo get_the_date('F j, Y'); ?></span>
      </div>
   <?php endif; ?>

   <h1 class="main--title uppercase"><?php the_title(); ?></h1>

   <?php if (has_post_thumbnail()) : ?>
      <div class="thumbnail-banner">
         <?php the_post_thumbnail('full'); ?>
      </div>
   <?php endif; ?>

   <div class="entry-content">
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