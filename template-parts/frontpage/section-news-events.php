<?php

$args = array(
   'post_type'      => 'post',
   'posts_per_page' => 5,
   'orderby'        => 'date',
   'order'          => 'DESC'
);
$query = new WP_Query($args);

if ($query->have_posts()) : ?>

   <section id="news-events">
      <div class="elem-hidden">
         <?php echo file_get_contents(IMPRESSION_THEME_URI . 'assets/images/accents/square-filled.svg'); ?>
         <?php echo file_get_contents(IMPRESSION_THEME_URI . 'assets/images/accents/square-hollow.svg'); ?>
         <?php echo file_get_contents(IMPRESSION_THEME_URI . 'assets/images/accents/triangle-right.svg'); ?>
      </div>
      <div class="page-width">
         <h2 class="hxl main--title uppercase">
            News & Events
            <svg class="float-shape" width="15" height="15">
               <use xlink:href="#triangle-right"></use>
            </svg>
         </h2>
      </div>
      <div class="news-container">
         <?php $query->the_post(); ?>
         <div class="col--left container">
            <?php get_template_part('template-parts/content/article', 'featured'); ?>
            <div class="floating-blocks-vertical">
               <svg class="float-shape" width="6" height="6">
                  <use xlink:href="#square-filled"></use>
               </svg>
               <svg class="float-shape" width="6" height="6">
                  <use xlink:href="#square-filled"></use>
               </svg>
               <svg class="float-shape" width="6" height="6">
                  <use xlink:href="#square-hollow"></use>
               </svg>
            </div>
         </div><!-- .left -->
         <?php if ($query->have_posts()) : ?>
            <div class="col--right">
               <div class="float-article-wrap">
                  <?php while ($query->have_posts()) : $query->the_post(); ?>
                     <?php get_template_part('template-parts/content/article', 'elem'); ?>
                  <?php endwhile; ?>
               </div>
            </div><!-- .right -->
         <?php endif; ?>
      </div>
   <?php wp_reset_postdata();
endif; ?>
   </section>